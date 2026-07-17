<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Exception;

class ServiceNotFoundException extends \InvalidArgumentException
{
    public function __construct(
        protected readonly string $serviceName,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
