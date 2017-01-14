<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 20:58
 */

namespace Yandex\Direct\Transport;

use Psr\Log\LoggerAwareInterface;
use Yandex\Direct\ConfigurableInterface;

interface TransportInterface extends ConfigurableInterface
{
    /**
     * @param string $serviceName
     * @return string
     */
    public function getServiceUrl($serviceName);

    /**
     * @param TransportRequest $request
     * @return TransportResponse
     */
    public function request(TransportRequest $request);
}
