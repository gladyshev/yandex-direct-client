<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 13.12.16 12:27
 */

namespace Yandex\Direct\Test;

use PHPUnit\Framework\TestCase;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Service;
use Yandex\Direct\ServiceFactory;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\RequestInterface;

class ServiceFactoryTest extends TestCase
{
    /**
     * @var ServiceFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ServiceFactory();
    }

    /**
     * @expectedException \Yandex\Direct\Exception\InvalidArgumentException
     */
    public function testMustThrowInvalidArgumentExceptionOnCallWithIncorrectService()
    {
        $this->factory->createService('notexistingservice', [
            ServiceFactory::OPTION_CREDENTIALS => new MockCredentials,
            ServiceFactory::OPTION_TRANSPORT => new MockTransport
        ]);
    }

    /**
     * @dataProvider providerYandexServices
     * @param $serviceName
     */
    public function testCreationService($serviceName)
    {
        $service = $this->factory->createService($serviceName, [
                ServiceFactory::OPTION_CREDENTIALS => new MockCredentials,
                ServiceFactory::OPTION_TRANSPORT => new MockTransport
        ]);
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf(Service::class, $service);
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


class ServiceFactoryMockCredentials implements CredentialsInterface {
    public function getMasterToken(){}
    public function getToken(){}
    public function getLogin(){}
}

class ServiceFactoryMockTransport implements TransportInterface {
    public function setOptions(array $options){}
    public function getServiceUrl($serviceName){}
    public function request(RequestInterface $request){}
}