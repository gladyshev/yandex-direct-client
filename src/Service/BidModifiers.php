<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:33
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

/**
 * Class BidModifiers
 * @package Yandex\Direct\Service
 */
final class BidModifiers extends Service
{
    /**
     * Создает корректировки ставок.
     *
     * @param $BidModifiers
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/add-docpage/
     */
    public function add($BidModifiers)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'BidModifiers' => $BidModifiers
            ]
        ]);
    }

    /**
     * Удаляет корректировки ставок.
     *
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/delete-docpage/
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
     * Возвращает параметры корректировок, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $MobileAdjustmentFieldNames
     * @param array $DemographicsAdjustmentFieldNames
     * @param array $RetargetingAdjustmentFieldNames
     * @param array $RegionalAdjustmentFieldNames
     * @param array $VideoAdjustmentFieldNames
     * @param array $SmartAdAdjustmentFieldNames
     * @param array $Page
     *
     * @return array
     *
     * @throws Exception
     * @throws \ReflectionException
     * @throws ErrorResponseException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $MobileAdjustmentFieldNames = null,
        $DemographicsAdjustmentFieldNames = null,
        $RetargetingAdjustmentFieldNames = null,
        $RegionalAdjustmentFieldNames = null,
        $VideoAdjustmentFieldNames = null,
        $SmartAdAdjustmentFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Изменяет значения коэффициентов в корректировках ставок.
     *
     * @param $BidModifiers
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/set-docpage/
     */
    public function setAuto($BidModifiers)
    {
        return $this->request([
            'method' => 'setAuto',
            'params' => [
                'BidModifiers' => $BidModifiers
            ]
        ]);
    }

    /**
     * Включает/выключает набор корректировок.
     *
     * @param $BidModifierToggleItems
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/toggle-docpage/
     */
    public function toggle($BidModifierToggleItems)
    {
        return $this->request([
            'method' => 'toggle',
            'params' => [
                'BidModifierToggleItems' => $BidModifierToggleItems
            ]
        ]);
    }
}
