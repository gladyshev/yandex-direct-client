<?php

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Ads
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Ads extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * @param $Ads
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/add-docpage/
     */
    public function add($Ads)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'Ads' => $Ads
            ]
        ]);
    }

    /**
     * @param $Ads
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/update-docpage/
     */
    public function update($Ads)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'Ads' => $Ads
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/delete-docpage/
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
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/suspend-docpage/
     */
    public function suspend($SelectionCriteria)
    {
        return $this->call([
            'method' => 'suspend',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/resume-docpage/
     */
    public function resume($SelectionCriteria)
    {
        return $this->call([
            'method' => 'resume',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/archive-docpage/
     */
    public function archive($SelectionCriteria)
    {
        return $this->call([
            'method' => 'archive',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/unarchive-docpage/
     */
    public function unarchive($SelectionCriteria)
    {
        return $this->call([
            'method' => 'unarchive',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/moderate-docpage/
     */
    public function moderate($SelectionCriteria)
    {
        return $this->call([
            'method' => 'moderate',
            'params' => [
                'SelectionCriteria' => $SelectionCriteria
            ]
        ]);
    }


    /**
     * Возвращает параметры объявлений, отвечающих заданным критериям.
     *
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $TextAdFieldNames
     * @param array $MobileAppAdFieldNames
     * @param array $DynamicTextAdFieldNames
     * @param array $TextImageAdFieldNames
     * @param array $MobileAppImageAdFieldNames
     * @param array $TextAdBuilderAdFieldNames
     * @param array $MobileAppAdBuilderAdFieldNames
     * @param array $CpcVideoAdBuilderAdFieldNames
     * @param array $CpmBannerAdBuilderAdFieldNames
     * @param array $CpmVideoAdBuilderAdFieldNames
     * @param array $SmartAdBuilderAdFieldNames
     * @param array $Page
     * @return array
     * @throws \Throwable
     * @throws ReflectionException
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
        $SmartAdBuilderAdFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
