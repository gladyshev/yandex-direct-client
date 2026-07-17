<?php

namespace Gladyshev\Yandex\Direct;

use Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException;
use Gladyshev\Yandex\Direct\Service\AdExtensions;
use Gladyshev\Yandex\Direct\Service\AdGroups;
use Gladyshev\Yandex\Direct\Service\AdImages;
use Gladyshev\Yandex\Direct\Service\Ads;
use Gladyshev\Yandex\Direct\Service\AgencyClients;
use Gladyshev\Yandex\Direct\Service\AudienceTargets;
use Gladyshev\Yandex\Direct\Service\BidModifiers;
use Gladyshev\Yandex\Direct\Service\Bids;
use Gladyshev\Yandex\Direct\Service\Campaigns;
use Gladyshev\Yandex\Direct\Service\Changes;
use Gladyshev\Yandex\Direct\Service\Clients;
use Gladyshev\Yandex\Direct\Service\Dictionaries;
use Gladyshev\Yandex\Direct\Service\DynamicTextAdTargets;
use Gladyshev\Yandex\Direct\Service\KeywordBids;
use Gladyshev\Yandex\Direct\Service\Keywords;
use Gladyshev\Yandex\Direct\Service\KeywordsResearch;
use Gladyshev\Yandex\Direct\Service\Reports;
use Gladyshev\Yandex\Direct\Service\RetargetingLists;
use Gladyshev\Yandex\Direct\Service\Sitelinks;
use Gladyshev\Yandex\Direct\Service\TurboPages;
use Gladyshev\Yandex\Direct\Service\VCards;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * @property AdExtensions $adExtensions
 * @property AdGroups $adGroups
 * @property AdImages $adImages
 * @property Ads $ads
 * @property AgencyClients $agencyClients
 * @property AudienceTargets $audienceTargets
 * @property BidModifiers $bidModifiers
 * @property Bids $bids
 * @property Campaigns $campaigns
 * @property Changes $changes
 * @property Clients $clients
 * @property Dictionaries $dictionaries
 * @property DynamicTextAdTargets $dynamicTextAdTargets
 * @property KeywordBids $keywordBids
 * @property Keywords $keywords
 * @property KeywordsResearch $keywordsResearch
 * @property Reports $reports
 * @property RetargetingLists $retargetingLists
 * @property Sitelinks $sitelinks
 * @property TurboPages $turboPages
 * @property VCards $vCards
 */
class Client implements ServiceFactoryInterface
{
    private const SERVICE_NAMESPACE = __NAMESPACE__ . '\\Service\\';

    /**
     * @var ServiceInterface[]
     */
    private array $services = [];

    public function __construct(
        private readonly CredentialsInterface $credentials,
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory
    ) {
    }

    #[\Override]
    public function createService(string $serviceName): ServiceInterface
    {
        if (!isset($this->services[$serviceName])) {
            $className = self::SERVICE_NAMESPACE . ucfirst($serviceName);

            if (!class_exists($className)) {
                throw new ServiceNotFoundException(
                    $serviceName,
                    "Class '{$className}' is not found."
                );
            }

            $classInstance = new $className(
                $serviceName,
                $this->credentials,
                $this->httpClient,
                $this->requestFactory,
                $this->streamFactory
            );

            if (!$classInstance instanceof ServiceInterface) {
                throw new ServiceNotFoundException(
                    $serviceName,
                    "Class '{$className}' must be an instance of '\Gladyshev\Yandex\Direct\ServiceInterface'."
                );
            }

            $this->services[$serviceName] = $classInstance;
        }

        return $this->services[$serviceName];
    }

    public function __get(string $serviceName): ServiceInterface
    {
        return $this->createService($serviceName);
    }
}
