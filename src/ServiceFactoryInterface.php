<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

/**
 * Interface ServiceFactoryInterface
 *
 * @author Dmitry Gladyshev <gladyshevd@icloud.com>
 */
interface ServiceFactoryInterface
{
    /**
     * Create a Service instance by name
     *
     * @param $serviceName
     * @return AbstractService
     */
    public function createService(string $serviceName): ServiceInterface;
}
