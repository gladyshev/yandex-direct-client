<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 12/01/2017 13:13
 */

namespace Yandex\Direct;

use Yandex\Direct\Transport\TransportInterface;

/**
 * Interface ServiceFactoryInterface
 *
 * @package Yandex\Direct
 */
interface ServiceFactoryInterface
{
    /**
     * Create a Service instance by name
     * @param $serviceName
     * @param CredentialsInterface $credentials
     * @param TransportInterface $transport
     * @param array $serviceOptions
     * @return Service
     */
    public function createService(
        $serviceName,
        CredentialsInterface $credentials,
        TransportInterface $transport,
        array $serviceOptions = []
    );
}
