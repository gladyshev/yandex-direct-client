<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 11:39
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;

class AgencyClients extends Service
{
    /**
     * Возвращает список рекламодателей — клиентов агентства,
     * их параметры и настройки главных представителей рекламодателя.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/agencyclients/get-docpage
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames
        ];

        if ($Page) {
            $params['Page'] = $Page;
        }

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}