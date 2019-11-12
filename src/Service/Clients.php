<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 29.11.16 14:09
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class Clients
 * @package Yandex\Direct\Service
 */
final class Clients extends Service
{
    /**
     * Возвращает параметры рекламодателя и представителя.
     *
     * @param array $FieldNames
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/clients/get-docpage/
     */
    public function get($FieldNames)
    {
        return $this->request([
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
     * @throws Exception
     * @throws \Yandex\Direct\Exception\ErrorResponseException
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/clients/update-docpage/
     */
    public function update($Clients)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'Clients' => $Clients
            ]
        ]);
    }
}
