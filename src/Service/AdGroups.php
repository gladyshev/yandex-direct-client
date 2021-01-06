<?php

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;
use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class AdGroups
 * @package Gladyshev\Yandex\Direct\Service
 */
final class AdGroups extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает группы объявлений.
     *
     * @param $AdGroups
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/add-docpage/
     */
    public function add($AdGroups)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'AdGroups' => $AdGroups
            ]
        ]);
    }

    /**
     * Удаляет группы объявлений.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/delete-docpage/
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
     * Возвращает параметры групп, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $MobileAppAdGroupFieldNames
     * @param array $DynamicTextAdGroupFieldNames
     * @param array $DynamicTextFeedAdGroupFieldNames
     * @param array $SmartAdGroupFieldNames
     * @param array $Page
     *
     * @return array
     *
     * @throws \Throwable
     * @throws ReflectionException
     * @throws ErrorResponseException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/delete-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $MobileAppAdGroupFieldNames = null,
        $DynamicTextAdGroupFieldNames = null,
        $DynamicTextFeedAdGroupFieldNames = null,
        $SmartAdGroupFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Изменяет параметры групп объявлений.
     *
     * @param $AdGroups
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/update-docpage/
     */
    public function update($AdGroups)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'AdGroups' => $AdGroups
            ]
        ]);
    }
}
