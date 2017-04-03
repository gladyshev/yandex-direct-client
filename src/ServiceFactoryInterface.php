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
    const OPTION_CREDENTIALS = 'credentials';
    const OPTION_TRANSPORT = 'transport';

    /**
     * Create a Service instance by name
     * @param $serviceName
     * @param array $serviceOptions
     * @return Service
     */
    public function createService($serviceName, array $serviceOptions = []);
}
