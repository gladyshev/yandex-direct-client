<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:34
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class Sitelinks
 * @package Yandex\Direct\Service
 */
final class Sitelinks extends Service
{
    /**
     * Создает наборы быстрых ссылок.
     *
     * @param $SitelinksSets
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/add-docpage/
     */
    public function add($SitelinksSets)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'SitelinksSets' => $SitelinksSets
            ]
        ]);
    }

    /**
     * Удаляет наборы быстрых ссылок.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/delete-docpage/
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
     * Возвращает наборы быстрых ссылок, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     *
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/get-docpage/
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
