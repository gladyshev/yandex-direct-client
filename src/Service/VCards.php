<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:35
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;

/**
 * Class VCards
 * @package Yandex\Direct\Service
 */
final class VCards extends Service
{
    /**
     * Создает виртуальные визитки.
     *
     * @param $VCards
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/add-docpage/
     */
    public function add($VCards)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'VCards' => $VCards
            ]
        ]);
    }

    /**
     * Удаляет виртуальные визитки.
     *
     * @param $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/delete-docpage/
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
     * Возвращает виртуальные визитки, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/vcards/get-docpage/
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
}
