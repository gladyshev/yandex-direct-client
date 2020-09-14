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
use Yandex\Direct\AbstractService;
use Gladyshev\Yandex\Direct\ServiceFactoryInterface;
use Yandex\Direct\Transport\ApiResponse;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\RequestInterface;


class ServiceTest extends TestCase
{
    /**
     * @covers AbstractService::setName()
     */
    public function testNameSetter()
    {
        $service = new DummyAbstractService;
        $name = "BlahBlahBlah";
        $service->setName($name);
        $this->assertEquals($name, $service->getName());
    }

    /**
     * @covers AbstractService::setTransport()
     */
    public function testTransportSetter()
    {
        $service = new DummyAbstractService;
        $transport = new MockTransport;
        $service->setTransport($transport);
        $this->assertEquals($transport, $service->getTransport());
    }

    /**
     * @covers AbstractService::setCredentials()
     */
    public function testCredentialsSetter()
    {
        $service = new DummyAbstractService;
        $mockCredentials = new MockCredentials;
        $service->setCredentials($mockCredentials);
        $this->assertEquals($mockCredentials, $service->getCredentials());
    }


    public function testDoingRequest()
    {
        $service = new DummyAbstractService;
        $service->setOptions([
            'transport' => new MockTransport(),
            'credentials' => new MockCredentials()
        ]);

        $response = $service->call([]);

        $this->assertArrayHasKey('results', $response);
        $this->assertArrayHasKey('units', $response);
        $this->assertArraySubset($response['units'], ['debit' => 0, 'limit' => 0,'rest' => 0]);
        $this->assertArrayHasKey('request_id', $response);
    }
}

class DummyAbstractService extends AbstractService {
    public function getName() { return $this->name;}
    public function getTransport() { return $this->transport;}
    public function getCredentials() {return $this->credentials;}
}

class MockTransport implements TransportInterface {
    public function setOptions(array $options){}
    public function getServiceUrl($serviceName){}
    public function request(RequestInterface $request) { return new ApiResponse([
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