<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class KeywordBids
 *
 * Сервис предназначен для назначения ставок и приоритетов ключевым фразам и автотаргетингам и для получения данных,
 * полезных при назначении ставок.
 *
 * @package Gladyshev\Yandex\Direct\Service
 * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/keywordbids-docpage/
 */
final class KeywordBids extends \Gladyshev\Yandex\Direct\AbstractService
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
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $SearchFieldNames = null,
        $NetworkFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Назначает фиксированные ставки и приоритеты для ключевых фраз и автотаргетингов.
     *
     * @param array $KeywordBids
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/set-docpage/
     */
    public function set($KeywordBids)
    {
        return $this->call([
            'method' => 'set',
            'params' => [
                'KeywordBids' => $KeywordBids
            ]
        ]);
    }

    /**
     * Назначает для фраз ставки на поиске в зависимости от желаемого объема трафика или ставки в сетях в зависимости
     * от желаемой частоты показа (доли аудитории).
     *
     * @param array $KeywordBids
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/keywordbids/setAuto-docpage/
     */
    public function setAuto($KeywordBids)
    {
        return $this->call([
            'method' => 'setAuto',
            'params' => [
                'KeywordBids' => $KeywordBids
            ]
        ]);
    }
}
