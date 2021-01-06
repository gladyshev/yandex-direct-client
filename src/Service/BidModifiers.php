<?php

namespace Gladyshev\Yandex\Direct\Service;

use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class BidModifiers
 * @package Gladyshev\Yandex\Direct\Service
 */
final class BidModifiers extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Создает корректировки ставок.
     *
     * @param $BidModifiers
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/add-docpage/
     */
    public function add($BidModifiers)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/delete-docpage/
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
     * @throws \Throwable
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

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * Изменяет значения коэффициентов в корректировках ставок.
     *
     * @param $BidModifiers
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/set-docpage/
     */
    public function setAuto($BidModifiers)
    {
        return $this->call([
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
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/toggle-docpage/
     */
    public function toggle($BidModifierToggleItems)
    {
        return $this->call([
            'method' => 'toggle',
            'params' => [
                'BidModifierToggleItems' => $BidModifierToggleItems
            ]
        ]);
    }
}
