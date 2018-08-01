<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 10:47
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\InvalidArgumentException;

/**
 * Class ConfigurableTrait
 * @package Yandex\Direct
 */

trait ConfigurableTrait
{
    /**
     * @param array $options
     * @param bool $ignoreMissingOptions
     * @throws InvalidArgumentException
     */
    public function setOptions(array $options, $ignoreMissingOptions = false)
    {
        foreach ($options as $option => $value) {
            $setter = 'set' . ucfirst($option);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
                continue;
            }

            if (property_exists($this, $option)) {
                $this->$option = $value;
                continue;
            }

            if (!$ignoreMissingOptions) {
                throw new InvalidArgumentException(
                    "Property `{$option}` not found in class `" . __CLASS__ . "`."
                );
            }
        }
    }
}
