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
    public function add(mixed $Campaigns)
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/delete-docpage/
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
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array|null $TextCampaignFieldNames
     * @param array|null $MobileAppCampaignFieldNames
     * @param array|null $DynamicTextCampaignFieldNames
     * @param array|null $CpmBannerCampaignFieldNames
     * @param array|null $SmartCampaignFieldNames
     * @param array|null $Page
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/get-docpage/
     */
    public function get(
        mixed $SelectionCriteria,
        mixed $FieldNames,
        mixed $TextCampaignFieldNames = null,
        mixed $MobileAppCampaignFieldNames = null,
        mixed $DynamicTextCampaignFieldNames = null,
        mixed $CpmBannerCampaignFieldNames = null,
        mixed $SmartCampaignFieldNames = null,
        mixed $Page = null
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/suspend-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/unarchive-docpage/
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
     * @param array $Campaigns
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-dynamic-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-mobile-app-campaign-docpage/
     */
    public function update(mixed $Campaigns)
    {
        return $this->call([
            'method' => 'update',
            'params' => [
                'Campaigns' => $Campaigns
            ]
        ]);
    }
}
