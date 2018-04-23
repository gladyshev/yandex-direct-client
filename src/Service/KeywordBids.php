<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/04/2018 09:50
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;

/**
 * Class KeywordBids
 *
 * Сервис предназначен для назначения ставок и приоритетов ключевым фразам и автотаргетингам и для получения данных,
 * полезных при назначении ставок.
 *
 * @package Yandex\Direct\Service
 * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/keywordbids-docpage/
 */
final class KeywordBids extends Service
{
    /**
     * Возвращает ставки и приоритеты для ключевых фраз и автотаргетингов, отвечающих заданным критериям,
     * а также данные торгов: ставки и списываемые цены для различных объемов трафика на поиске и ставки для охвата
     * различных долей аудитории в сетях.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $SearchFieldNames
     * @param array $NetworkFieldNames
     * @param array $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $SearchFieldNames = null,
        $NetworkFieldNames = null,
        $Page = null
    ) {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
        ];

        if ($SearchFieldNames) {
            $params['SearchFieldNames'] = $SearchFieldNames;
        }

        if ($NetworkFieldNames) {
            $params['NetworkFieldNames'] = $NetworkFieldNames;
        }

        if ($Page) {
            $params['Page'] = $Page;
        }

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Назначает фиксированные ставки и приоритеты для ключевых фраз и автотаргетингов.
     *
     * @param array $KeywordBids
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/set-docpage/
     */
    public function set($KeywordBids)
    {
        return $this->request([
            'method' => 'set',
            'params' => [
                'KeywordBids' => $KeywordBids
            ]
        ]);
    }
}
