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
use Yandex\Direct\Service\AgencyClients;
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
use Yandex\Direct\Transport\Json\Transport;
use Yandex\Direct\Transport\TransportInterface;

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
 * @method AgencyClients agencyClients(array $options)
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
 * @property AgencyClients $agencyClients
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
     * @var ServiceFactoryInterface
     */
    protected $serviceFactory;

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param string $login
     * @param string $token
     * @param string $masterToken
     * @param array $options
     * @return static
     */
    public static function build($login, $token, $masterToken = '', array $options = [])
    {
        return new static(
            new Credentials($login, $token, $masterToken),
            new Transport,
            $options
        );
    }

    /**
     * @param CredentialsInterface $credentials
     * @param TransportInterface $transport
     * @param array $options
     */
    public function __construct(
        CredentialsInterface $credentials,
        TransportInterface $transport,
        array $options = []
    )
    {
        $this->credentials = $credentials;
        $this->transport = $transport;
        $this->options = $options;
    }

    /**
     * @param string $serviceName
     * @param array $args
     * @return Service
     */
    public function __call($serviceName, array $args = [])
    {
        $options = array_merge($this->options, (current($args) ?: []));

        return $this->getServiceFactory()->createService(
            $serviceName,
            $this->credentials,
            $this->transport,
            $options
        );
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
     * @param CredentialsInterface $credentials
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param ServiceFactoryInterface $serviceFactory
     */
    public function setServiceFactory($serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * @return ServiceFactoryInterface
     */
    protected function getServiceFactory()
    {
        if ($this->serviceFactory === null) {
            $this->serviceFactory = new ServiceFactory;
        }
        return $this->serviceFactory;
    }
}
