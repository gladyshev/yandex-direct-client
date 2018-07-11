<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:34
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class DynamicTextAdTargets
 * @package Yandex\Direct\Service
 */
final class DynamicTextAdTargets extends Service
{
    /**
     * Создает условия нацеливания для динамических объявлений,
     * назначает ставки или приоритеты для создаваемых условий.
     *
     * @param $Webpages
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/add-docpage/
     */
    public function add($Webpages)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'Webpages' => $Webpages
            ]
        ]);
    }

    /**
     * Удаляет условия нацеливания для динамических объявлений.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/delete-docpage/
     */
    public function delete($SelectionCriteria)
    {
        return $this->request([
            'method' => 'delete',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Возвращает параметры условий нацеливания для динамических объявлений.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
        ];

        if ($Page) {
            $params['Page'] = $Page;
        }

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Возобновляет показы по ранее остановленным условиям нацеливания для динамических объявлений.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->request([
            'method' => 'resume',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * Назначает ставки и приоритеты для условий нацеливания для динамических объявлений.
     *
     * @param $Bids
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/setBids-docpage/
     */
    public function setBids($Bids)
    {
        return $this->request([
            'method' => 'setBids',
            'params' => [
                'Bids' => $Bids
            ]
        ]);
    }

    /**
     * Останавливает показы по условиям нацеливания для динамических объявлений.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->request([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }
}
