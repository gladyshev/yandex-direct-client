<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 13:51
 */

namespace Yandex\Direct\Service;

use ReflectionException;
use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;
use function Yandex\Direct\get_param_names;

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
     * @throws Exception
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

        return $this->request([
            'method' => 'get',
            'params' => $params
        ]);
    }
}
