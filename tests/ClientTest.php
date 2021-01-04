<?php
/**
 * @project yandex-direct-client
 */

namespace Gladyshev\Yandex\Direct\Tests;

use Gladyshev\Yandex\Direct\Client;
use Gladyshev\Yandex\Direct\Exception\ServiceNotFoundException;
use Gladyshev\Yandex\Direct\ServiceInterface;
use Gladyshev\Yandex\Direct\Tests\Mocks\Credentials;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected $client;

    public function setUp(): void
    {
        $credentials = new Credentials;
        $httpClient = new \GuzzleHttp\Client();

        $this->client = new Client($credentials, $httpClient);
    }

    /**
     * @dataProvider validServicesDataProvider
     */
    public function testCreateService(string $serviceName): void
    {
        $instance = $this->client->createService($serviceName);

        $this->assertInstanceOf(ServiceInterface::class, $instance);
    }

    /**
     * @dataProvider invalidServicesDataProvider
     */
    public function testExceptionOnInvalidServiceName(string $serviceName): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->client->createService($serviceName);
    }

    public function invalidServicesDataProvider(): array
    {
        return [
            ['fuck'],
            ['nop'],
            ['piu']
        ];
    }

    public function validServicesDataProvider(): array
    {
        return [
            ['AdExtensions'],
            ['AdGroups'],
            ['AdImages'],
            ['Ads'],
            ['AgencyClients'],
            ['AudienceTargets'],
            ['BidModifiers'],
            ['Bids'],
            ['Businesses'],
            ['Campaigns'],
            ['Changes'],
            ['Clients'],
            ['Creatives'],
            ['Dictionaries'],
            ['DynamicTextAdTargets'],
            ['KeywordBids'],
            ['Keywords'],
            ['KeywordsResearch'],
            ['Leads'],
            ['NegativeKeywordSharedSets'],
            ['Reports'],
            ['RetargetingLists'],
            ['Sitelinks'],
            ['TurboPages'],
            ['VCards'],
        ];
    }
}
