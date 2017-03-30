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
     * Resolve API url by service name.
     *
     * @param string $serviceName
     * @return string
     */
    public function getServiceUrl($serviceName);

    /**
     * Request API.
     *
     * @param TransportRequestInterface $request
     * @return TransportResponseInterface
     */
    public function request(TransportRequestInterface $request);
}
