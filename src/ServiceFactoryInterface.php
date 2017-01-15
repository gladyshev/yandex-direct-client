<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 12/01/2017 13:13
 */

namespace Yandex\Direct;

/**
 * Interface ServiceFactoryInterface
 *
 * @package Yandex\Direct
 */
interface ServiceFactoryInterface
{
    /**
     * Create a Service instance by name
     * @param string $name
     * @param array $options
     * @return Service
     */
    public function createService($name, array $options = []);

    /**
     * Update default new service options
     * @param array $options
     * @return void
     */
    public function setDefaultOptions(array $options);
}
