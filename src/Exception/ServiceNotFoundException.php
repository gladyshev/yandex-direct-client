<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Exception;

class ServiceNotFoundException extends \InvalidArgumentException
{
    protected $serviceName;

    public function __construct(
        string $serviceName,
        string $message = '',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->serviceName = $serviceName;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
