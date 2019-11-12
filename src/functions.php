<?php
/**
 * @project yandex-direct-client
 */

namespace Yandex\Direct;

/**
 * @param string $method
 * @return array
 * @throws \ReflectionException
 */
function get_param_names($method)
{
    list($class, $method) = explode('::', $method);

    $refParams = (new \ReflectionMethod($class, $method))->getParameters();

    $paramNames = [];

    foreach ($refParams as $parameter) {
        $paramNames[] = $parameter->name;
    }

    return $paramNames;
}

/**
 * @param array $params
 * @return array
 */
function filter_params(array $params)
{
    return array_filter($params, function ($value) {
        return !is_null($value);
    });
}
