<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

/**
 * Yandex.Direct v5 API client implementation
 *
 * @property \Gladyshev\Yandex\Direct\Service\AdExtensions $adExtensions
 * @property \Gladyshev\Yandex\Direct\Service\AdGroups $adGroups
 * @property \Gladyshev\Yandex\Direct\Service\AdImages $adImages
 * @property \Gladyshev\Yandex\Direct\Service\Ads $ads
 * @property \Gladyshev\Yandex\Direct\Service\AgencyClients $agencyClients
 * @property \Gladyshev\Yandex\Direct\Service\AudienceTargets $audienceTargets
 * @property \Gladyshev\Yandex\Direct\Service\BidModifiers $bidModifiers
 * @property \Gladyshev\Yandex\Direct\Service\Bids $bids
 * @property \Gladyshev\Yandex\Direct\Service\Campaigns $campaigns
 * @property \Gladyshev\Yandex\Direct\Service\Changes $changes
 * @property \Gladyshev\Yandex\Direct\Service\Clients $clients
 * @property \Gladyshev\Yandex\Direct\Service\Dictionaries $dictionaries
 * @property \Gladyshev\Yandex\Direct\Service\DynamicTextAdTargets $dynamicTextAdTargets
 * @property \Gladyshev\Yandex\Direct\Service\KeywordBids $keywordBids
 * @property \Gladyshev\Yandex\Direct\Service\Keywords $keywords
 * @property \Gladyshev\Yandex\Direct\Service\KeywordsResearch $keywordsResearch
 * @property \Gladyshev\Yandex\Direct\Service\Reports $reports
 * @property \Gladyshev\Yandex\Direct\Service\RetargetingLists $retargetingLists
 * @property \Gladyshev\Yandex\Direct\Service\Sitelinks $sitelinks
 * @property \Gladyshev\Yandex\Direct\Service\TurboPages $turboPages
 * @property \Gladyshev\Yandex\Direct\Service\VCards $vCards
 */
class Client implements ServiceFactoryInterface
{
    private const SERVICE_NAMESPACE = __NAMESPACE__ . '\\Service\\';

    /**
     * @var \Gladyshev\Yandex\Direct\ServiceInterface[]
     */
    private $services = [];

    /**
     * @var \Gladyshev\Yandex\Direct\CredentialsInterface
     */
    private $credentials;

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    private $httpClient;

    public function __construct(
        CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    ) {
        $this->credentials = $credentials;
        $this->httpClient = $httpClient;
    }

    public function createService(string $serviceName): \Gladyshev\Yandex\Direct\ServiceInterface
    {
        if (!isset($this->services[$serviceName])) {
            $className = self::SERVICE_NAMESPACE . ucfirst($serviceName);

            if (!class_exists($className)) {
                throw new \Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException(
                    $serviceName,
                    "Class '{$className}' is not found."
                );
            }

            $classInstance = new $className($serviceName, $this->credentials, $this->httpClient);

            if (!$classInstance instanceof \Gladyshev\Yandex\Direct\ServiceInterface) {
                throw new \Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException(
                    $serviceName,
                    "Class '{$className}' must be an instance of '\Gladyshev\Yandex\Direct\ServiceInterface'."
                );
            }

            $this->services[$serviceName] = $classInstance;
        }

        return $this->services[$serviceName];
    }

    public function __get(string $serviceName): \Gladyshev\Yandex\Direct\ServiceInterface
    {
        return $this->createService($serviceName);
    }
}
