<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 20:58
 */

namespace Yandex\Direct\Transport;

use Yandex\Direct\ConfigurableInterface;

/**
 * Interface TransportInterface
 * @package Yandex\Direct\Transport
 */
interface TransportInterface extends ConfigurableInterface
{
    /**
     * Return classname using as TransportRequestInterface.
     *
     * @return string
     */
    public function getRequestClass();

    /**
     * Return classname using as TransportResponseInterface.
     *
     * @return string
     */
    public function getResponseClass();

    /**
     * Resolve API url by service name.
     *
     * @param string $serviceName
     * @return string
     */
    public function getServiceUrl($serviceName);

    /**
     * Request API.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function request(RequestInterface $request);
}
