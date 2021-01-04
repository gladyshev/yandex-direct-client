<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

interface ServiceInterface
{
    public function getName(): string;
    public function getCredentials(): \Gladyshev\Yandex\Direct\CredentialsInterface;
    public function call(array $params = []): array;
}
