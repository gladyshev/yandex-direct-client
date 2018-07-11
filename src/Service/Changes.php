<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:33
 */

namespace Yandex\Direct\Service;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Service;

/**
 * Class Changes
 * @package Yandex\Direct\Service
 */
final class Changes extends Service
{
    /**
     * Сообщает о наличии изменений в справочниках часовых поясов и регионов начиная с указанной даты.
     * Также используется для получения текущего серверного времени.
     *
     * @param $Timestamp
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/checkDictionaries-docpage/
     */
    public function checkDictionaries($Timestamp)
    {
        return $this->request([
            'method' => 'checkDictionaries',
            'params' => [
                'Timestamp' => $Timestamp
            ]
        ]);
    }

    /**
     * Сообщает о наличии изменений в кампаниях клиента начиная с указанной даты.
     *
     * @param $Timestamp
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/checkCampaigns-docpage/
     */
    public function checkCampaigns($Timestamp)
    {
        return $this->request([
            'method' => 'checkCampaigns',
            'params' => [
                'Timestamp' => $Timestamp
            ]
        ]);
    }

    /**
     * Сообщает о наличии изменений в кампаниях, группах и объявлениях клиента начиная с указанной даты.
     *
     * @param $Timestamp
     * @param $FieldNames
     * @param $CampaignIds
     * @param $AdGroupIds
     * @param $AdIds
     * @return array
     * @throws Exception
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/check-docpage/
     */
    public function check($Timestamp, $FieldNames, $CampaignIds = null, $AdGroupIds = null, $AdIds = null)
    {
        $params = [
            'Timestamp' => $Timestamp,
            'FieldNames' => $FieldNames
        ];

        if ($CampaignIds) {
            $params['CampaignIds'] = $CampaignIds;
        }

        if ($AdGroupIds) {
            $params['AdGroupIds'] = $AdGroupIds;
        }

        if ($AdIds) {
            $params['AdIds'] = $AdIds;
        }

        return $this->request([
            'method' => 'check',
            'params' => $params
        ]);
    }
}
