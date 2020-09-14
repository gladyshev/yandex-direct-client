<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 29/08/2016 12:33
 */

namespace Gladyshev\Yandex\Direct\Service;

use ReflectionException;


use function Gladyshev\Yandex\Direct\get_param_names;

/**
 * Class Changes
 * @package Gladyshev\Yandex\Direct\Service
 */
final class Changes extends \Gladyshev\Yandex\Direct\AbstractService
{
    /**
     * Сообщает о наличии изменений в справочниках часовых поясов и регионов начиная с указанной даты.
     * Также используется для получения текущего серверного времени.
     *
     * @param $Timestamp
     * @return array
     * @throws \Throwable
     * @throws ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/checkDictionaries-docpage/
     */
    public function checkDictionaries($Timestamp = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'checkDictionaries',
            'params' => $params
        ]);
    }

    /**
     * Сообщает о наличии изменений в кампаниях клиента начиная с указанной даты.
     *
     * @param $Timestamp
     * @return array
     * @throws \Throwable
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/checkCampaigns-docpage/
     */
    public function checkCampaigns($Timestamp)
    {
        return $this->call([
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
     * @throws \Throwable
     * @throws \ReflectionException
     *
     * @see https://tech.yandex.ru/direct/doc/ref-v5/changes/check-docpage/
     */
    public function check($Timestamp, $FieldNames, $CampaignIds = null, $AdGroupIds = null, $AdIds = null)
    {
        $params = compact(get_param_names(__METHOD__));

        return $this->call([
            'method' => 'check',
            'params' => $params
        ]);
    }
}
