<?php

namespace Gladyshev\Yandex\Direct;

/**
 * @param string $method
 * @return array
 * @throws \ReflectionException
 */
function get_param_names(string $method): array
{
    [$class, $method] = explode('::', $method);

    $refParams = (new \ReflectionMethod($class, $method))->getParameters();

    $paramNames = [];

    foreach ($refParams as $parameter) {
        $paramNames[] = $parameter->name;
    }

    return $paramNames;
}
