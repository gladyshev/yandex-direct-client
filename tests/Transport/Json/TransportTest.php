<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 12:51
 */

namespace Yandex\Direct\Test\Transport\Json;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Test\Helper;
use Yandex\Direct\Transport\Json\Transport;
use Yandex\Direct\Transport\Request;

/**
 * Class JsonTransport
 * @package Yandex\Direct\Test\Transport
 */
class TransportTest extends TestCase
{
    public function testResolvingServiceUrls()
    {
        $transport = new Transport;
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
        $transport = new Transport;
        $transport->setOptions([
            'httpClient' => self::buildMockHttpClient($body, $headers, $code)
        ]);

        $request = self::buildMockTransportRequest();

        $response = $transport->request($request);

        $this->assertEquals($response->getBody(), $body);
        $this->assertEquals($response->getHeaders(), $headers);
    }


    public function testLoggerMiddleware()
    {
        $tr = new Transport;
        $tr->setLogger(new MockPsr3Logger);

        $loggerGetterReflection = Helper::getPrivateMethod($tr, 'getLogger');
        $this->assertInstanceOf(
            MockPsr3Logger::class,
            $loggerGetterReflection->invoke($tr)
        );

        $messageFormatterGetterReflection = Helper::getPrivateMethod($tr, 'getMessageFormatter');
        $this->assertInstanceOf(
            MessageFormatter::class,
            $messageFormatterGetterReflection->invoke($tr)
        );

        $httpHandlerStackGetterReflection = Helper::getPrivateMethod($tr, 'getHttpHandlers');
        $this->assertInstanceOf(
            HandlerStack::class,
            $httpHandlerStackGetterReflection->invoke($tr)
        );
    }

    public function testHeadersSetter()
    {
        $headers = [
          'a' => 'b',
          'c' => 'd',
          'e' => 'f'
        ];

        $tr = new Transport;
        $tr->setHeaders($headers);
        $this->assertArraySubset($headers, Helper::getPrivateProperty(Transport::class, 'headers')->getValue($tr));
    }


    public function providerMockYandexDirectResponse()
    {
        return [
            ['{"jsonData":[1,2,3]}', [], 200]
        ];
    }

    private static function buildMockTransportRequest()
    {
        return new Request([
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

class MockPsr3Logger extends AbstractLogger {
    public function log($level, $message, array $context = array()) {}
}
