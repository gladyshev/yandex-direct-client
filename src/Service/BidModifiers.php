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
    public function add(mixed $BidModifiers)
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
    public function delete(mixed $SelectionCriteria)
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
     * @param array|null $MobileAdjustmentFieldNames
     * @param array|null $DemographicsAdjustmentFieldNames
     * @param array|null $RetargetingAdjustmentFieldNames
     * @param array|null $RegionalAdjustmentFieldNames
     * @param array|null $VideoAdjustmentFieldNames
     * @param array|null $SmartAdAdjustmentFieldNames
     * @param array|null $Page
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
        mixed $SelectionCriteria,
        mixed $FieldNames,
        mixed $MobileAdjustmentFieldNames = null,
        mixed $DemographicsAdjustmentFieldNames = null,
        mixed $RetargetingAdjustmentFieldNames = null,
        mixed $RegionalAdjustmentFieldNames = null,
        mixed $VideoAdjustmentFieldNames = null,
        mixed $SmartAdAdjustmentFieldNames = null,
        mixed $Page = null
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
    public function setAuto(mixed $BidModifiers)
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
    public function toggle(mixed $BidModifierToggleItems)
    {
        return $this->call([
            'method' => 'toggle',
            'params' => [
                'BidModifierToggleItems' => $BidModifierToggleItems
            ]
        ]);
    }
}
