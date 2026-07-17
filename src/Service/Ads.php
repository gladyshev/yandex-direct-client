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
    public function add(mixed $Ads)
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
    public function update(mixed $Ads)
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
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * https://tech.yandex.ru/direct/doc/ref-v5/ads/suspend-docpage/
     */
    public function suspend(mixed $SelectionCriteria)
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
    public function resume(mixed $SelectionCriteria)
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
    public function archive(mixed $SelectionCriteria)
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
    public function unarchive(mixed $SelectionCriteria)
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
    public function moderate(mixed $SelectionCriteria)
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
     * @param array|null $TextAdFieldNames
     * @param array|null $MobileAppAdFieldNames
     * @param array|null $DynamicTextAdFieldNames
     * @param array|null $TextImageAdFieldNames
     * @param array|null $MobileAppImageAdFieldNames
     * @param array|null $TextAdBuilderAdFieldNames
     * @param array|null $MobileAppAdBuilderAdFieldNames
     * @param array|null $CpcVideoAdBuilderAdFieldNames
     * @param array|null $CpmBannerAdBuilderAdFieldNames
     * @param array|null $CpmVideoAdBuilderAdFieldNames
     * @param array|null $SmartAdBuilderAdFieldNames
     * @param array|null $Page
     * @return array
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/ads/get-docpage/
     */
    public function get(
        mixed $SelectionCriteria,
        mixed $FieldNames,
        mixed $TextAdFieldNames = null,
        mixed $MobileAppAdFieldNames = null,
        mixed $DynamicTextAdFieldNames = null,
        mixed $TextImageAdFieldNames = null,
        mixed $MobileAppImageAdFieldNames = null,
        mixed $TextAdBuilderAdFieldNames = null,
        mixed $MobileAppAdBuilderAdFieldNames = null,
        mixed $CpcVideoAdBuilderAdFieldNames = null,
        mixed $CpmBannerAdBuilderAdFieldNames = null,
        mixed $CpmVideoAdBuilderAdFieldNames = null,
        mixed $SmartAdBuilderAdFieldNames = null,
        mixed $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
