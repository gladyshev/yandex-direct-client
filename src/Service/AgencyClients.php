<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 11:39
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use Throwable;

final class AgencyClients extends Service
{
    /**
     * Возвращает список рекламодателей — клиентов агентства,
     * их параметры и настройки главных представителей рекламодателя.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/agencyclients/get-docpage
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        return $this->request([
            'method' => 'get',
            'params' => array_filter([
                'SelectionCriteria' => $SelectionCriteria,
                'FieldNames' => $FieldNames,
                'Page' => $Page
            ])
        ]);
    }

    /**
     * Регистрирует новых рекламодателей — клиентов агентства,
     * а также пользователей — главных представителей рекламодателя.
     *
     * @param $Login
     * @param $FirstName
     * @param $LastName
     * @param $Currency
     * @param $Grants
     * @param $Notification
     * @param $Settings
     * @return array
     * @throws Exception
     * @throws Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/agencyclients/add-docpage/
     */
    public function add($Login, $FirstName, $LastName, $Currency, $Notification, $Grants = null, $Settings = null)
    {
        return $this->request([
            'method' => 'add',
            'params' => array_filter([
                'Login' => $Login,
                'FirstName' => $FirstName,
                'LastName' => $LastName,
                'Currency' => $Currency,
                'Grants' => $Grants,
                'Notification' => $Notification,
                'Setting' => $Settings
            ])
        ]);
    }

    /**
     * Изменяет параметры рекламодателей — клиентов агентства, а также настройки пользователей —
     * главных представителей рекламодателя.
     *
     * @inheritDoc
     * @param $Clients
     * @throws Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/agencyclients/update-docpage/
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
