<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 10:37
 */

namespace Yandex\Direct;

use Yandex\Direct\Service\AdExtensions;
use Yandex\Direct\Service\AdGroups;
use Yandex\Direct\Service\AdImages;
use Yandex\Direct\Service\Ads;
use Yandex\Direct\Service\AudienceTargets;
use Yandex\Direct\Service\BidModifiers;
use Yandex\Direct\Service\Bids;
use Yandex\Direct\Service\Campaigns;
use Yandex\Direct\Service\Changes;
use Yandex\Direct\Service\Clients;
use Yandex\Direct\Service\Dictionaries;
use Yandex\Direct\Service\DynamicTextAdTargets;
use Yandex\Direct\Service\Keywords;
use Yandex\Direct\Service\RetargetingLists;
use Yandex\Direct\Service\Sitelinks;
use Yandex\Direct\Service\VCards;


/**
 * Yandex.Direct v5 API client implementation
 *
 * @package Yandex\Direct
 *
 * Yandex Services
 * @method AdExtensions adExtensions(array $options = [])
 * @method AdGroups adGroups(array $options = [])
 * @method AdImages adImages(array $options = [])
 * @method Ads ads(array $options = [])
 * @method AudienceTargets audienceTargets(array $options = [])
 * @method BidModifiers bidModifiers(array $options = [])
 * @method Bids bids(array $options = [])
 * @method Campaigns campaigns(array $options = [])
 * @method Clients clients(array $options = [])
 * @method Changes changes(array $options = [])
 * @method Dictionaries dictionaries(array $options = [])
 * @method DynamicTextAdTargets dynamicTextAdsTargets(array $options = [])
 * @method Keywords keywords(array $options = [])
 * @method RetargetingLists retargetingLists(array $options = [])
 * @method Sitelinks sitelinks(array $options = [])
 * @method VCards vCards(array $options = [])
 *
 * Aliases (sugar)
 * @property AdExtensions $adExtensions
 * @property AdGroups $adGroups
 * @property AdImages $adImages
 * @property Ads $ads
 * @property AudienceTargets $audienceTargets
 * @property BidModifiers $bidModifiers
 * @property Bids $bids
 * @property Campaigns $campaigns
 * @property Clients $clients
 * @property Changes $changes
 * @property Dictionaries $dictionaries
 * @property DynamicTextAdTargets $dynamicTextAdsTargets
 * @property Keywords $keywords
 * @property RetargetingLists $retargetingLists
 * @property Sitelinks $sitelinks
 * @property VCards $vCards
 */
class Client
{
    /**
     * @var ServiceFactory
     */
    protected $factory;

    /**
     * @param CredentialsInterface $credentials
     * @param array $options
     */
    public function __construct(CredentialsInterface $credentials, array $options = [])
    {
        $this->factory = new ServiceFactory;
        $this->factory->setDefaultOptions(array_merge([
            'credentials' => $credentials
        ], $options));
    }

    /**
     * @param string $name
     * @param array $options
     * @return Service
     */
    public function __call($name, array $options = [])
    {
        return $this->factory->createService($name, current($options) ?: []);
    }

    /**
     * @param string $name
     * @return Service
     */
    public function __get($name)
    {
        return $this->__call($name);
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->factory->setDefaultOptions($options);
    }
}