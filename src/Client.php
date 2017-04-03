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
     * Service options.
     * @var array
     */
    protected $options = [];

    /**
     * Client constructor with overloading.
     *
     * @param mixed[] ...$args    The order of the arguments doesn't matter.
     *                            Credentials is required, it can be CredentialsInterface instance or
     *                            login and token strings in order.
     *      Example:
     *      $client = new Client('login', 'token');
     *      $client = new Client(new Credentials('login', 'token'));
     *      $client = new Client(new Credentials('login', 'token'), ['useOperatorUnits' => true]);
     *      $client = new Client('login', 'token', ['useOperatorUnits' => true]);
     *      $client = new Client('login', 'token', new Transport(['logger' => new Log]), ['useOperatorUnits' => true]);
     *      // etc
     */
    public function __construct(...$args)
    {
        if (empty($args)) {
            return;
        }

        $strArgs = [];

        foreach ($args as $key => $val) {
            if ($val instanceof CredentialsInterface) {
                $this->setCredentials($val);
            } elseif ($val instanceof TransportInterface) {
                $this->setTransport($val);
            } elseif (is_array($val)) {
                $this->setOptions($val);
            } elseif (is_string($val)) {
                $strArgs[] = $val;
            }
        }

        list($login, $token, $masterToken) = array_pad($strArgs, 3, '');

        if ($login && $token) {
            $this->setCredentials(new Credentials($login, $token, $masterToken));
        }
    }

    /**
     * Returns specific Service instance.
     *
     * @param string $serviceName # The Name of Yandex service
     * @param array $args # The First argument is the service options override.
     * @return Service
     */
    public function __call($serviceName, array $args = [])
    {
        $userOptions = isset($args[0]) && is_array($args[0]) ? $args[0] : [];
        $options = array_merge($this->options, $userOptions);

        return $this
            ->getServiceFactory()
            ->createService($serviceName, $options);
    }

    /**
     * Alias of __call()
     *
     * @param string $name
     * @return Service
     * @see Client::__call()
     */
    public function __get($name)
    {
        return $this->__call($name);
    }

    /* Setters & Getters */

    /**
     * @param mixed[] $credentials
     * @return $this
     */
    public function setCredentials(...$credentials)
    {
        if ($credentials[0] instanceof CredentialsInterface) {
            $this->options[ServiceFactoryInterface::OPTION_CREDENTIALS] = $credentials[0];
        } else {
            list($login, $token, $masterToken) = array_pad($credentials, 3, '');
            $this->options[ServiceFactoryInterface::OPTION_CREDENTIALS] = new Credentials($login, $token, $masterToken);
        }
        return $this;
    }

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->options[ServiceFactoryInterface::OPTION_TRANSPORT] = $transport;
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param ServiceFactoryInterface $serviceFactory
     * @return $this
     */
    public function setServiceFactory(ServiceFactoryInterface $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
        return $this;
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
