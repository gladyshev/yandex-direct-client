<?php

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class AdExtensions
 * @package Gladyshev\Yandex\Direct\Service
 */
final class AdExtensions extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает расширения.
     *
     * @param $AdExtensions
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/add-docpage/
     */
    public function add($AdExtensions)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'AdExtensions' => $AdExtensions
            ]
        ]);
    }

    /**
     * Удаляет расширения.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/delete-docpage/
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
     * Возвращает расширения, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $CalloutFieldNames
     * @param $Page
     *
     * @return array

     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $CalloutFieldNames = null, $Page = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
