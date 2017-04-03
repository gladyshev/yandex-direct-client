<?php
/**
 * @author Dmitry Gladyshev <dgladyshev@seopult.ru>
 * @date 13.12.16 12:44
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Service;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\RequestInterface;


class ServiceTest extends TestCase
{
    public function testNameSetter()
    {
        $service = new DummyService;
        $name = "BlahBlahBlah";
        $service->setName($name);
        $this->assertEquals($name, $service->getName());
    }

    public function testTransportSetter()
    {
        $service = new DummyService;
        $transport = new MockTransport;
        $service->setTransport($transport);
        $this->assertEquals($transport, $service->getTransport());
    }

    public function testCredentialsSetter()
    {
        $service = new DummyService;
        $mockCredentials = new MockCredentials;
        $service->setCredentials($mockCredentials);
        $this->assertEquals($mockCredentials, $service->getCredentials());
    }
}

class DummyService extends Service {
    public function getName() {return $this->name;}
    public function getTransport() {return $this->transport;}
    public function getCredentials() {return $this->credentials;}
}

class MockTransport implements TransportInterface {
    public function setOptions(array $options){}
    public function getServiceUrl($serviceName){}
    public function request(RequestInterface $request){}
}

class MockCredentials implements CredentialsInterface {
    public function getMasterToken(){}
    public function getToken(){}
    public function getLogin(){}
}