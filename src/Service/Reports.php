<?php

namespace Gladyshev\Yandex\Direct\Service;

use Gladyshev\Yandex\Direct\Exception\InvalidArgumentException;

use LSS\Array2XML;
use LSS\XML2Array;

use function Gladyshev\Yandex\Direct\get_param_names;


final class Reports extends \Gladyshev\Yandex\Direct\AbstractService
{
    const PROCESSING_MODE_AUTO = 'auto';
    const PROCESSING_MODE_OFFLINE = 'offline';
    const PROCESSING_MODE_ONLINE = 'online';

    private $skipReportHeader = false;
    private $skipReportSummary = false;
    private $enableReportValidation = false;
    private $processingMode = self::PROCESSING_MODE_AUTO;
    private $reportsXmlSchema = 'https://api.direct.yandex.com/v5/reports.xsd';
    /**
     * Спецификация отчета.
     *
     * @param $SelectionCriteria
     * @param $Goals
     * @param $FieldNames
     * @param $ReportName
     * @param $ReportType
     * @param $DateRangeType
     * @param $Format
     * @param $IncludeVAT
     * @param $IncludeDiscount
     * @param $Page
     * @param $OrderBy
     *
     * @return string
     *
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/reports/spec-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $ReportName,
        $ReportType,
        $DateRangeType,
        $Page = null,
        $OrderBy = null,
        $IncludeVAT = 'YES',
        $IncludeDiscount = 'YES',
        $Format = 'TSV',
        $Goals = []
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'params' => $params
        ]);
    }

    /**
     * Режим формирования отчета: online, offline или auto.
     * Отсутствие заголовка эквивалентно значению auto.
     *
     * @param $processingMode
     * @return $this
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setProcessingMode($processingMode)
    {
        $this->headers['processingMode'] = $processingMode;
        return $this;
    }

    /**
     * Если заголовок указан, денежные значения в отчете возвращаются в валюте с точностью до двух знаков после
     * запятой. Если не указан, денежные значения возвращаются в виде целых чисел — сумм в валюте,
     * умноженных на 1 000 000.
     *
     * @param $returnMoneyInMicros
     * @return $this
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setReturnMoneyInMicros($returnMoneyInMicros)
    {
        if (is_numeric($returnMoneyInMicros) || is_bool($returnMoneyInMicros)) {
            $returnMoneyInMicros = $returnMoneyInMicros ? 'true' : 'false';
        }
        $this->headers['returnMoneyInMicros'] = $returnMoneyInMicros;
        return $this;
    }

    /**
     * Не выводить в отчете строку с названием отчета и диапазоном дат.
     * @return $this
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setSkipReportHeader()
    {
        $this->headers['skipReportHeader'] = 'true';
        return $this;
    }

    /**
     * Не выводить в отчете строку с названиями полей.
     *
     * @return $this
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setSkipColumnHeader()
    {
        $this->headers['skipColumnHeader'] = 'true';
        return $this;
    }

    /**
     * Не выводить в отчете строку с количеством строк статистики.
     *
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setSkipReportSummary()
    {
        $this->skipReportSummary = true;
        return $this;
    }

    public function enableReportValidation()
    {
        $this->enableReportValidation = true;
        return $this;
    }

    protected function handleResponse(
        \Psr\Http\Message\ResponseInterface $response,
        \Psr\Http\Message\RequestInterface $request
    ): array {
        if ($response->getStatusCode() >= 400) {
            $result = XML2Array::createArray($response->getBody());
            $result = $result['reports:reportDownloadError']['reports:ApiError'];
            throw new \Gladyshev\Yandex\Direct\Exception\ErrorResponseException(
                $result['reports:errorMessage'],
                $result['reports:errorDetail'],
                $result['reports:errorCode'],
                $request,
                $response
            );
        }

        $result = [
            'request_id' => current($response->getHeader('RequestId'))
        ];

        if ($response->getStatusCode() == 201
            || $response->getStatusCode() == 202
        ) {
            $result['retryIn'] = $response->getHeaders()['retryIn'];
            return $result;
        }

        $result['report'] = $response->getBody();

        return $result;
    }

    protected function prepareBody(array $params): string
    {
        $xml = Array2XML::createXML(
            'ReportDefinition',
            ['@attributes' => ['xmlns' => 'http://api.direct.yandex.com/v5/reports']] + $params
        );

        if ($this->enableReportValidation) {
            $this->validateReportXml($xml);
        }

        return str_replace(PHP_EOL, '', $xml->saveXML());
    }

    protected function getHeaders(): array
    {
        $headers = parent::getHeaders();

        if ($this->skipReportHeader) {
            $headers['skipReportHeader'] = 'true';
        }

        if ($this->skipReportSummary) {
            $headers['skipReportSummary'] = 'true';
        }



        return $headers;
    }

    /**
     * @param \DOMDocument $xml
     * @throws InvalidArgumentException
     */
    private function validateReportXml(\DOMDocument $xml)
    {
        libxml_use_internal_errors(true);
        if (!$xml->schemaValidate($this->reportsXmlSchema)) {
            $error = libxml_get_last_error();
            libxml_clear_errors();
            throw new InvalidArgumentException($error->message, $error->code);
        }
    }
}
