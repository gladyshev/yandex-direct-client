<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:33
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

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
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $MobileAdjustmentFieldNames
     * @param $DemographicsAdjustmentFieldNames
     * @param $RetargetingAdjustmentFieldNames
     * @param $Page
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/bidmodifiers/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $MobileAdjustmentFieldNames = null,
        $DemographicsAdjustmentFieldNames = null,
        $RetargetingAdjustmentFieldNames = null,
        $Page = null
    ) {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames
        ];

        if ($MobileAdjustmentFieldNames) {
            $params['MobileAdjustmentFieldNames'] = $MobileAdjustmentFieldNames;
        }

        if ($DemographicsAdjustmentFieldNames) {
            $params['DemographicsAdjustmentFieldNames'] = $DemographicsAdjustmentFieldNames;
        }

        if ($RetargetingAdjustmentFieldNames) {
            $params['RetargetingAdjustmentFieldNames'] = $RetargetingAdjustmentFieldNames;
        }

        if ($Page) {
            $params['Page'] = $Page;
        }

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
