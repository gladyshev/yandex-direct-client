<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 13:44
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

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
     * @throws Exception
     *
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
     * @throws Exception
     *
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
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adimages/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
