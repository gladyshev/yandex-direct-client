<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 17:20
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use Yandex\Direct\Client;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\AbstractService;
use Yandex\Direct\Transport\RequestInterface;
use Yandex\Direct\Transport\TransportInterface;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client('***', '***');
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
        $this->assertInstanceOf(AbstractService::class, $service);

        unset($service);

        $service = $this->client->{$serviceName};
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf(AbstractService::class, $service);
    }

    /**
     * @dataProvider providerYandexServices
     * @param $serviceName
     */
    public function testHasAllServicesWithCallMagic($serviceName)
    {
        $service = $this->client->{lcfirst($serviceName)}();
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf(AbstractService::class, $service);

        unset($service);

        $service = $this->client->{$serviceName}();
        $this->assertInstanceOf('Yandex\\Direct\\Service\\' . $serviceName, $service);
        $this->assertInstanceOf(AbstractService::class, $service);
    }

    public function providerYandexServices()
    {
        return Helper::getServicesDataset();
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