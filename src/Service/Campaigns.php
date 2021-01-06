<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Service;

use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Campaigns
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Campaigns extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * @param array $Campaigns
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-dynamic-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-mobile-app-campaign-docpage/
     */
    public function add($Campaigns)
    {
        return $this->call([
            'method' => 'add',
            'params' => [
                'Campaigns' => $Campaigns
            ]
        ]);
    }

    /**
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/archive-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/delete-docpage/
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
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $TextCampaignFieldNames
     * @param array $MobileAppCampaignFieldNames
     * @param array $DynamicTextCampaignFieldNames
     * @param array $CpmBannerCampaignFieldNames
     * @param array $SmartCampaignFieldNames
     * @param array $Page
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/get-docpage/
     */
    public function get(
        $SelectionCriteria,
        $FieldNames,
        $TextCampaignFieldNames = null,
        $MobileAppCampaignFieldNames = null,
        $DynamicTextCampaignFieldNames = null,
        $CpmBannerCampaignFieldNames = null,
        $SmartCampaignFieldNames = null,
        $Page = null
    ) {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'get',
            'params' => $params
        ]);
    }

    /**
     * @param $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/resume-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/suspend-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/unarchive-docpage/
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
     * @param array $Campaigns
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-dynamic-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-mobile-app-campaign-docpage/
     */
    public function update($Campaigns)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'Campaigns' => $Campaigns
            ]
        ]);
    }
}
