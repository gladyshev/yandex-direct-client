<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

final class AgencyClients extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Возвращает список рекламодателей — клиентов агентства,
     * их параметры и настройки главных представителей рекламодателя.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/agencyclients/get-docpage
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        return $this->call([
            'method' => 'get',
            'params' => array_filter(compact(get_param_names(__METHOD__)))
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/agencyclients/add-docpage/
     */
    public function add($Login, $FirstName, $LastName, $Currency, $Notification, $Grants = null, $Settings = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'add',
            'params' => $params
        ]);
    }

    /**
     * Изменяет параметры рекламодателей — клиентов агентства, а также настройки пользователей —
     * главных представителей рекламодателя.
     *
     * @inheritDoc
     * @param $Clients
     * @throws \Throwable
     *
     * @see https://yandex.ru/dev/direct/doc/ref-v5/agencyclients/update-docpage/
     */
    public function update($Clients)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'Clients' => $Clients
            ]
        ]);
    }

    protected function getHeaders(): array
    {
        $headers = parent::getHeaders();

        unset($headers['Client-Login']);

        return $headers;
    }
}
