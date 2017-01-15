<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 12:51
 */

namespace Yandex\Direct\Test\Transport;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Transport\JsonTransport;
use Yandex\Direct\Transport\TransportRequest;

/**
 * Class JsonTransport
 * @package Yandex\Direct\Test\Transport
 */
class JsonTransportTest extends \PHPUnit_Framework_TestCase
{
    public function testResolvingServiceUrls()
    {
        $transport = new JsonTransport;
        $transport->setOptions([
            'baseUrl' => 'https://api-sandbox.yandex.direct',
            'serviceUrls' => [
                'A' => '/json/v5/ads',
                'B' => 'http://api.yandex.direct.com/json/v5/ads',
                'C' => 'https://api.yandex.direct.com/json/v5/ads'
            ]
        ]);

        foreach (['A', 'B', 'C', 'D'] as $service) {
            $this->assertRegExp('#http[s]*://#u', $a = $transport->getServiceUrl($service));
        }
    }

    /**
     * @param $body
     * @param array $headers
     * @param int $code
     * @dataProvider providerMockYandexDirectResponse
     */
    public function testDoingRequests($body, $headers, $code)
    {
        $transport = new JsonTransport;
        $transport->setOptions([
            'httpClient' => self::buildMockHttpClient($body, $headers, $code)
        ]);

        $request = self::buildMockTransportRequest();

        $response = $transport->request($request);

        $this->assertEquals($response->getBody(), $body);
        $this->assertEquals($response->getHeaders(), $headers);
    }

    public function providerMockYandexDirectResponse()
    {
        return [
            ['{"jsonData":[1,2,3]}', [], 200]
        ];
    }

    private static function buildMockTransportRequest()
    {
        return new TransportRequest([
            'credentials' => new MockCredentials,
            'service' => 'service',
            'method' => 'method'
        ]);
    }

    private static function buildMockHttpClient($body, $headers = [], $code = 200)
    {
        $mock = new MockHandler([
            new Response($code, $headers, $body)
        ]);

        $handler = HandlerStack::create($mock);

        return new HttpClient([
            'handler' => $handler
        ]);
    }

}

class MockCredentials implements CredentialsInterface {
    public function getMasterToken() { return ''; }
    public function getToken() { return ''; }
    public function getLogin() { return ''; }
}