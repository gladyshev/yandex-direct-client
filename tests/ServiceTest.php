<?php
/**
 * @author Dmitry Gladyshev <dgladyshev@seopult.ru>
 * @date 13.12.16 12:44
 */

namespace Yandex\Direct\Test;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Service;
use Yandex\Direct\ServiceFactoryInterface;
use Yandex\Direct\Transport\Response;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\RequestInterface;


class ServiceTest extends TestCase
{
    /**
     * @covers Service::setName()
     */
    public function testNameSetter()
    {
        $service = new DummyService;
        $name = "BlahBlahBlah";
        $service->setName($name);
        $this->assertEquals($name, $service->getName());
    }

    /**
     * @covers Service::setTransport()
     */
    public function testTransportSetter()
    {
        $service = new DummyService;
        $transport = new MockTransport;
        $service->setTransport($transport);
        $this->assertEquals($transport, $service->getTransport());
    }

    /**
     * @covers Service::setCredentials()
     */
    public function testCredentialsSetter()
    {
        $service = new DummyService;
        $mockCredentials = new MockCredentials;
        $service->setCredentials($mockCredentials);
        $this->assertEquals($mockCredentials, $service->getCredentials());
    }


    public function testDoingRequest()
    {
        $service = new DummyService;
        $service->setOptions([
            'transport' => new MockTransport(),
            'credentials' => new MockCredentials()
        ]);

        $response = $service->request([]);

        $this->assertArrayHasKey('results', $response);
        $this->assertArrayHasKey('units', $response);
        $this->assertArraySubset($response['units'], ['debit' => 0, 'limit' => 0,'rest' => 0]);
        $this->assertArrayHasKey('request_id', $response);
    }
}

class DummyService extends Service {
    public function getName() { return $this->name;}
    public function getTransport() { return $this->transport;}
    public function getCredentials() {return $this->credentials;}
}

class MockTransport implements TransportInterface {
    public function setOptions(array $options){}
    public function getServiceUrl($serviceName){}
    public function request(RequestInterface $request) { return new Response([
        'headers' => [],
        'body' => '{"results":{}}',
        'requestId' => '1234567890',
        'units' => '0/0/0'
    ]);}
}

class MockCredentials implements CredentialsInterface {
    public function getMasterToken(){}
    public function getToken(){}
    public function getLogin(){}
}