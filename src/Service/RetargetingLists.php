<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class RetargetingLists
 * @package Gladyshev\Yandex\Direct\Service
 */
final class RetargetingLists extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает условия подбора аудитории.
     *
     * @param $RetargetingLists
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/add-docpage/

     */
    public function add($RetargetingLists)
    {
        return $this->call([
            'method' => 'get',
            'params' => [
                'RetargetingLists' => $RetargetingLists
            ]
        ]);
    }

    /**
     * Удаляет условия подбора аудитории.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/delete-docpage/
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
     * Возвращает условия подбора аудитории.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/get-docpage/
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
     * Изменяет параметры условий подбора аудитории.
     *
     * @param $RetargetingLists
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/update-docpage/
     */
    public function update($RetargetingLists)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'RetargetingLists' => $RetargetingLists
            ]
        ]);
    }
}
