<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 22/08/2016 16:05
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class AdGroups
 * @package Yandex\Direct\Service
 */
final class AdGroups extends Service
{
    /**
     * Создает группы объявлений.
     *
     * @param $AdGroups
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/add-docpage/
     */
    public function add($AdGroups)
    {
        return $this->request([
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
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/delete-docpage/
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
     * Возвращает параметры групп, отвечающих заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $MobileAppAdGroupFieldNames
     * @param $DynamicTextAdGroupFieldNames
     * @param $DynamicTextFeedAdGroupFieldNames
     * @param $Page
     * @return array
     *
     * @throws Exception
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/delete-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $MobileAppAdGroupFieldNames = null,
        $DynamicTextAdGroupFieldNames = null,
        $DynamicTextFeedAdGroupFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Изменяет параметры групп объявлений.
     *
     * @param $AdGroups
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/adgroups/update-docpage/
     */
    public function update($AdGroups)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'AdGroups' => $AdGroups
            ]
        ]);
    }
}
