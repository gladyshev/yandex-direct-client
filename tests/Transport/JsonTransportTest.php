<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 12:51
 */

namespace Yandex\Direct\Test\Transport;


use Yandex\Direct\Transport\JsonTransport;

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


}