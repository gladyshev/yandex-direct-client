<?php

namespace Gladyshev\Yandex\Direct;

interface ServiceInterface
{
    public function call(array $params = []): array;
}
