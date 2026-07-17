<?php

namespace Gladyshev\Yandex\Direct\Service;

/**
 * Class Clients
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Clients extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Возвращает параметры рекламодателя и представителя.
     *
     * @param array $FieldNames
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/clients/get-docpage/
     */
    public function get(mixed $FieldNames)
    {
        return $this->call([
            'method' => 'get',
            'params' => [
                'FieldNames' => $FieldNames
            ]
        ]);
    }

    /**
     * Изменяет параметры рекламодателя и настройки пользователя — представителя рекламодателя.
     *
     * @param $Clients
     * @return array
     *
     * @throws \Throwable
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/clients/update-docpage/
     */
    public function update(mixed $Clients)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'Clients' => $Clients
            ]
        ]);
    }
}
