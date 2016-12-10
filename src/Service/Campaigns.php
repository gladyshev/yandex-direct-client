<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 14:03
 */

namespace Yandex\Direct\Service;


use Yandex\Direct\Service;

/**
 * Class Campaigns
 * @package Yandex\Direct\Service
 */
final class Campaigns extends Service
{

    /**
     * @param array $Campaigns
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-dynamic-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/add-mobile-app-campaign-docpage/
     */
    public function add($Campaigns)
    {
        return $this->request([
            'method' => 'add',
            'params' => [
                'Campaigns' => $Campaigns
            ]
        ]);
    }

    /**
     * @param array $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/archive-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/delete-docpage/
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
     * @param array $SelectionCriteria
     * @param array $FieldNames
     * @param array $TextCampaignFieldNames
     * @param array $MobileAppCampaignFieldNames
     * @param array $DynamicTextCampaignFieldNames
     * @param array $Page
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/get-docpage/
     */
    public function get($SelectionCriteria,
                        $FieldNames,
                        $TextCampaignFieldNames = null,
                        $MobileAppCampaignFieldNames = null,
                        $DynamicTextCampaignFieldNames = null,
                        $Page = null
    ) {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames' => $FieldNames,
        ];

        if ($TextCampaignFieldNames) {
            $params['TextCampaignFieldNames'] = $TextCampaignFieldNames;
        }

        if ($MobileAppCampaignFieldNames) {
            $params['MobileAppCampaignFieldNames'] = $MobileAppCampaignFieldNames;
        }

        if ($DynamicTextCampaignFieldNames) {
            $params['DynamicTextCampaignFieldNames'] = $DynamicTextCampaignFieldNames;
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
     * @param $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/resume-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/suspend-docpage/
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
     * @param array $SelectionCriteria
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/unarchive-docpage/
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
     * @param array $Campaigns
     * @return array
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-dynamic-text-campaign-docpage/
     * @see https://tech.yandex.ru/direct/doc/ref-v5/campaigns/update-mobile-app-campaign-docpage/
     */
    public function update($Campaigns)
    {
        return $this->request([
            'method' => 'update',
            'params' => [
                'Campaigns' => $Campaigns
            ]
        ]);
    }
}