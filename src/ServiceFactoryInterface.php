<?php

namespace Gladyshev\Yandex\Direct;

interface ServiceFactoryInterface
{
    /**
     * Create a Service instance by name
     */
    public function createService(string $serviceName): ServiceInterface;
}
