<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 14:42
 */

namespace Yandex\Direct;


interface ConfigurableInterface
{
    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options);
}