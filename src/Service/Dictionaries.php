<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:33
 */

namespace Yandex\Direct\Service;


use Yandex\Direct\Service;

/**
 * Class Dictionaries
 * @package Yandex\Direct\Service
 */
final class Dictionaries extends Service
{
    /**
     * Возвращает справочные данные: регионы, часовые пояса, курсы валют, список станций метрополитена,
     * ограничения на значения параметров, внешние сети (SSP) и др.
     *
     * @param $DictionaryNames
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dictionaries/get-docpage/
     */
    public function get($DictionaryNames)
    {
        return $this->request([
            'method' => 'get',
            'params' => [
                'DictionaryNames' => $DictionaryNames
            ]
        ]);
    }
}