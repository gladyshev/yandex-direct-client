<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:34
 */

namespace Gladyshev\Yandex\Direct\Service;



use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Sitelinks
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Sitelinks extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает наборы быстрых ссылок.
     *
     * @param $SitelinksSets
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/add-docpage/
     */
    public function add($SitelinksSets)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/delete-docpage/
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
     * Возвращает наборы быстрых ссылок, отвечающие заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $Page
     * @return array
     *
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/sitelinks/get-docpage/
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
