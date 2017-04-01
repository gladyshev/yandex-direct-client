<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 17:20
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use Yandex\Direct\Client;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Transport\RequestInterface;
use Yandex\Direct\Transport\TransportInterface;

class ApiTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client(new ClientMockCredentials, new ClientMockTransport);
    }

    public function testCanBeCreatedByBuilder()
    {
        $this->assertInstanceOf(
            Client::class,
            Client::build('', '')
        );
    }

    /**
     * @expectedException \Yandex\Direct\Exception\InvalidArgumentException
     */
    public function testInvalidServiceExceptionGetMagic()
    {
        $this->client->hahaImNotExistinService;
    }

    /**
     * @expectedException \Yandex\Direct\Exception\InvalidArgumentException
     */
    public function testInvalidServiceExceptionCallMagic()
    {
        $this->client->hahaImNotExistinService();
    }


    /**
     * @dataProvider providerYandexServices
     * @param $serviceName
     */
    public function testHasAllServicesWithGetMagic($serviceName)
    {
        $service = $this->client->{lcfirst($serviceName)};
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf('Yandex\\Direct\\Service', $service);

        unset($service);

        $service = $this->client->{$serviceName};
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf('Yandex\\Direct\\Service', $service);
    }

    /**
     * @dataProvider providerYandexServices
     * @param $serviceName
     */
    public function testHasAllServicesWithCallMagic($serviceName)
    {
        $service = $this->client->{lcfirst($serviceName)}();
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf('Yandex\\Direct\\Service', $service);

        unset($service);

        $service = $this->client->{$serviceName}();
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf('Yandex\\Direct\\Service', $service);
    }


    public function providerYandexServices()
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
            ['Campaigns'],
            ['Changes'],
            ['Dictionaries'],
            ['DynamicTextAdTargets'],
            ['Keywords'],
            ['RetargetingLists'],
            ['Sitelinks'],
            ['VCards'],
        ];
    }
}


class ClientMockCredentials implements CredentialsInterface {
    public function getMasterToken() { return '';}
    public function getToken() { return '';}
    public function getLogin() { return '';}
}

class ClientMockTransport implements TransportInterface {
    public function setOptions(array $options){}
    public function getServiceUrl($serviceName){}
    public function request(RequestInterface $request){}
    public function getRequestClass() { return ''; }
    public function getResponseClass() { return ''; }
}