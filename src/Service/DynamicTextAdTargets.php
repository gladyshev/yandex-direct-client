<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class DynamicTextAdTargets
 * @package Gladyshev\Yandex\Direct\Service
 */
final class DynamicTextAdTargets extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает условия нацеливания для динамических объявлений,
     * назначает ставки или приоритеты для создаваемых условий.
     *
     * @param $Webpages
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/add-docpage/
     */
    public function add($Webpages)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/delete-docpage/
     */
    public function delete($SelectionCriteria)
    {
        return $this->call([
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
     *
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Возобновляет показы по ранее остановленным условиям нацеливания для динамических объявлений.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/setBids-docpage/
     */
    public function setBids($Bids)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/dynamictextadtargets/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->call([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }
}
