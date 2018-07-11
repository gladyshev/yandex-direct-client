<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 03.12.16 15:26
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class RetargetingLists
 * @package Yandex\Direct\Service
 */
final class RetargetingLists extends Service
{
    /**
     * Создает условия подбора аудитории.
     *
     * @param $RetargetingLists
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/add-docpage/

     */
    public function add($RetargetingLists)
    {
        return $this->request([
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
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/delete-docpage/
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
     * Возвращает условия подбора аудитории.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/get-docpage/
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
     * Изменяет параметры условий подбора аудитории.
     *
     * @param $RetargetingLists
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/retargetinglists/update-docpage/
     */
    public function update($RetargetingLists)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'RetargetingLists' => $RetargetingLists
            ]
        ]);
    }
}
