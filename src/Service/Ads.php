<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 13:51
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class Ads
 * @package Yandex\Direct\Service
 */
final class Ads extends Service
{
    /**
     * @param $Ads
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/add-docpage/
     */
    public function add($Ads)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'Ads' => $Ads
            ]
        ]);
    }

    /**
     * @param $Ads
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/update-docpage/
     */
    public function update($Ads)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'Ads' => $Ads
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/delete-docpage/
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
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->request([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->request([
            'method' => 'resume',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/archive-docpage/
     */
    public function archive($SelectionCriteria)
    {
        return $this->request([
            'method' => 'archive',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/unarchive-docpage/
     */
    public function unarchive($SelectionCriteria)
    {
        return $this->request([
            'method' => 'unarchive',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws Exception
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/moderate-docpage/
     */
    public function moderate($SelectionCriteria)
    {
        return $this->request([
            'method' => 'moderate',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }


    /**
     * Возвращает параметры объявлений, отвечающих заданным критериям.
     *
     * @param $SelectionCriteria
     * @param $FieldNames
     * @param $TextAdFieldNames
     * @param $MobileAppAdFieldNames
     * @param $DynamicTextAdFieldNames
     * @param $TextImageAdFieldNames
     * @param $MobileAppImageAdFieldNames
     * @param $TextAdBuilderAdFieldNames
     * @param $MobileAppAdBuilderAdFieldNames
     * @param $CpcVideoAdBuilderAdFieldNames
     * @param $CpmBannerAdBuilderAdFieldNames
     * @param $CpmVideoAdBuilderAdFieldNames
     * @param $Page
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $TextAdFieldNames = null,
        $MobileAppAdFieldNames = null,
        $DynamicTextAdFieldNames = null,
        $TextImageAdFieldNames = null,
        $MobileAppImageAdFieldNames = null,
        $TextAdBuilderAdFieldNames = null,
        $MobileAppAdBuilderAdFieldNames = null,
        $CpcVideoAdBuilderAdFieldNames = null,
        $CpmBannerAdBuilderAdFieldNames = null,
        $CpmVideoAdBuilderAdFieldNames = null,
        $Page = null
    )
    {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames
        ];

        if ($TextAdFieldNames) {
            $params['TextAdFieldNames'] = $TextAdFieldNames;
        }

        if ($MobileAppAdFieldNames) {
            $params['MobileAppAdFieldNames'] = $MobileAppAdFieldNames;
        }

        if ($DynamicTextAdFieldNames) {
            $params['DynamicTextAdFieldNames'] = $DynamicTextAdFieldNames;
        }

        if ($TextImageAdFieldNames) {
            $params['TextImageAdFieldNames'] = $TextImageAdFieldNames;
        }

        if ($MobileAppImageAdFieldNames) {
            $params['MobileAppImageAdFieldNames'] = $MobileAppImageAdFieldNames;
        }

        if ($TextAdBuilderAdFieldNames) {
            $params['TextAdBuilderAdFieldNames'] = $TextAdBuilderAdFieldNames;
        }

        if ($MobileAppAdBuilderAdFieldNames) {
            $params['MobileAppAdBuilderAdFieldNames'] = $MobileAppAdBuilderAdFieldNames;
        }

        if ($CpcVideoAdBuilderAdFieldNames) {
            $params['CpcVideoAdBuilderAdFieldNames'] = $CpcVideoAdBuilderAdFieldNames;
        }

        if ($CpmBannerAdBuilderAdFieldNames) {
            $params['CpmBannerAdBuilderAdFieldNames'] = $CpmBannerAdBuilderAdFieldNames;
        }

        if ($CpmVideoAdBuilderAdFieldNames) {
            $params['CpmVideoAdBuilderAdFieldNames'] = $CpmVideoAdBuilderAdFieldNames;
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
