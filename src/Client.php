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
class Client implements \Gladyshev\Yandex\Direct\ServiceFactoryInterface
{
    /**
     * @var \Gladyshev\Yandex\Direct\CredentialsInterface
     */
    private $credentials;

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    private $httpClient;

    public function __construct(
        \Gladyshev\Yandex\Direct\CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    ) {
        $this->credentials = $credentials;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $name
     * @return ServiceInterface
     * @throws \Throwable
     */
    public function __get(string $name)
    {
        return $this->createService($name);
    }

    public function createService(string $serviceName): \Gladyshev\Yandex\Direct\ServiceInterface
    {
        $className = __NAMESPACE__ . '\\Service\\' . ucfirst($serviceName);

        if (!class_exists($className)) {
            throw new \Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException(
                "Service class `{$className}` is not found."
            );
        }

        $isService = (new \ReflectionClass($className))->implementsInterface(
            \Gladyshev\Yandex\Direct\ServiceInterface::class
        );

        if (!$isService) {
            throw new \Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException(
                "Service class `{$className}` must implements " . \Gladyshev\Yandex\Direct\ServiceInterface::class
            );
        }

        return new $className(
            $this->credentials,
            $this->httpClient
        );
    }
}
