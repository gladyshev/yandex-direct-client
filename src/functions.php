<?php

namespace Gladyshev\Yandex\Direct;

use ReflectionException;
use ReflectionMethod;

/**
 * @throws ReflectionException
 */
function get_param_names(string $method): array
{
    [$class, $method] = explode('::', $method);

    return array_map(
        static fn (\ReflectionParameter $parameter): string => $parameter->name,
        (new ReflectionMethod($class, $method))->getParameters()
    );
}
