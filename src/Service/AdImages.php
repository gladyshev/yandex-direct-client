<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class AdImages
 * @package Gladyshev\Yandex\Direct\Service
 */
final class AdImages extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Выполняет синхронную загрузку изображений в виде бинарных данных.
     *
     * @param $AdImages
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/add-docpage/
     */
    public function add($AdImages)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/delete-docpage/
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
     * Возвращает изображения, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
