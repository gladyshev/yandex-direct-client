<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 17:20
 */

namespace Yandex\Direct\Test;


use Yandex\Direct\Client;
use Yandex\Direct\CredentialsInterface;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client(new DummyCredentials);
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


class DummyCredentials implements CredentialsInterface {
    public function getMasterToken() { return '';}
    public function getToken() { return '';}
    public function getLogin() { return '';}
}