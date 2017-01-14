<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 13:44
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;

/**
 * Class AdImages
 * @package Yandex\Direct\Service
 */
final class AdImages extends Service
{
    /**
     * Выполняет синхронную загрузку изображений в виде бинарных данных.
     *
     * @param $AdImages
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/add-docpage/
     */
    public function add($AdImages)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'AdImages' => $AdImages
            ]
        ]);
    }

    /**
     * Удаляет изображения.
     *
     * @param $SelectionCriteria
     * @return mixed
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/delete-docpage/
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
     * Возвращает изображения, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/get-docpage/
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
