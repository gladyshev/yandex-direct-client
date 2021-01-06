<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

interface ServiceInterface
{
    public function call(array $params = []): array;
}
