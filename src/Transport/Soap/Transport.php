<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 01.04.17 23:31
 */

namespace Yandex\Direct\Transport\Soap;

use Yandex\Direct\Transport\RequestInterface;
use Yandex\Direct\Transport\ResponseInterface;
use Yandex\Direct\Transport\TransportInterface;

/**
 * Class Transport
 */
class Transport implements TransportInterface
{
    /**
     * Request API.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function request(RequestInterface $request)
    {
        // TODO: Implement request() method.
    }
}
