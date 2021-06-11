<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

final class Reports extends \Gladyshev\Yandex\Direct\AbstractService
{
    private $skipReportHeader = false;
    private $skipReportSummary = false;
    private $headers = [];

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
     * @return array
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
    ): array {
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
    public function setProcessingMode($processingMode): self
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
    public function setReturnMoneyInMicros($returnMoneyInMicros): self
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
    public function setSkipReportHeader(): self
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
    public function setSkipColumnHeader(): self
    {
        $this->headers['skipColumnHeader'] = 'true';
        return $this;
    }

    /**
     * Не выводить в отчете строку с количеством строк статистики.
     *
     * @see https://tech.yandex.ru/direct/doc/reports/headers-docpage/
     */
    public function setSkipReportSummary(): self
    {
        $this->skipReportSummary = true;
        return $this;
    }

    protected function handleResponse(
        \Psr\Http\Message\RequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response
    ): array {
        $contents = $response->getBody()->getContents();

        if ($response->getStatusCode() >= 400) {
            $parsedBody = json_decode($contents, true);
            if ($parsedBody && !empty($parsedBody['error'])) {
                throw new \Gladyshev\Yandex\Direct\Exception\ErrorResponseException(
                    $parsedBody['error']['error_string'],
                    $parsedBody['error']['error_detail'],
                    (int)$parsedBody['error']['error_code'],
                    $request,
                    $response
                );
            }

            throw new \Gladyshev\Yandex\Direct\Exception\ErrorResponseException(
                'Unexpected API response.',
                $contents,
                0,
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
            $result['retryIn'] = current($response->getHeader('retryIn'));

            return $result;
        }

        $result['report'] = $contents;

        return $result;
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
}
