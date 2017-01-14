<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 15:16
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;

/**
 * Class AdExtensions
 * @package Yandex\Direct\Service
 */
final class AdExtensions extends Service
{
    /**
     * Создает расширения.
     *
     * @param $AdExtensions
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/add-docpage/
     */
    public function add($AdExtensions)
    {
        return $this->request([
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
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/delete-docpage/
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
     * Возвращает расширения, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $CalloutFieldNames
     * @param $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adextensions/get-docpage/
     */
    public function get($SelectionCriteria, $FieldNames, $CalloutFieldNames = null, $Page = null)
    {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
        ];

        if ($CalloutFieldNames) {
            $params['CalloutFieldNames'] = $CalloutFieldNames;
        }

        if ($Page) {
            $params['Page'] = $Page;
        }

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
