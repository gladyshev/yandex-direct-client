<?php

namespace Gladyshev\Yandex\Direct\Service;

/**
 * Class Dictionaries
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Dictionaries extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Возвращает справочные данные: регионы, часовые пояса, курсы валют, список станций метрополитена,
     * ограничения на значения параметров, внешние сети (SSP) и др.
     *
     * @param $DictionaryNames
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dictionaries/get-docpage/
     */
    public function get($DictionaryNames)
    {
        return $this->call([
            'method' => 'get',
            'params' => [
                'DictionaryNames' => $DictionaryNames
            ]
        ]);
    }
}
