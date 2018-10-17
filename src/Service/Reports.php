<?php

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class Reports
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 */
final class Reports extends Service
{
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
     * @return string
     * @throws Exception
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
    
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
            'Page' => $Page,
            'OrderBy' => $OrderBy,
            'ReportName' => $ReportName, 
            'ReportType' => $ReportType, 
            'DateRangeType' => $DateRangeType,
            'Format' => $Format,
            'IncludeVAT' => $IncludeVAT, 
            'IncludeDiscount' => $IncludeDiscount,
        ];

        if (!empty($Goals)) {
            $params['Goals'] = $Goals;
        }

        if ($Page) {
            $params['Page'] = $Page;
        } else {
            unset($params['Page']);
        }

        if ($OrderBy) {
            $params['OrderBy'] = $OrderBy;
        } else {
            unset($params['OrderBy']);
        }

        return $this->request([
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
        $this->headers['skipReportSummary'] = 'true';
        return $this;
    }
}
