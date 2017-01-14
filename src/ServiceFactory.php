<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 13:42
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\InvalidArgumentException;
use Yandex\Direct\Transport\TransportInterface;

/**
 * Class ServiceFactory
 *
 * @package Yandex\Direct
 */
class ServiceFactory
{
    const E_INVALID_NAME = 1;
    const E_INVALID_OPTION = 2;

    /**
     * Default Service options
     *
     * @var array
     */
    protected $defaultOptions = [
        'transport' => 'Yandex\\Direct\\Transport\\JsonTransport',
        'transportOptions' => [],
        'credentials' => null
    ];

    /**
     * Set default service options
     *
     * @param array $options
     */
    public function setDefaultOptions(array $options)
    {
        $this->defaultOptions = array_merge($this->defaultOptions, $options);
    }

    /**
     * @param string $serviceName
     * @param array $options
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function createService($serviceName, array $options = [])
    {
        $className = $this->getServiceNamespace() . '\\' . ucfirst($serviceName);

        // Override service base options
        $options = array_merge($this->defaultOptions, [
            'name' => $serviceName
        ], $options);

        // Create transport instance if got classname
        if (is_string($options['transport'])) {
            $options['transport'] = $this->buildTransport(
                $options['transport'],
                $options['transportOptions']
            );
        }

        unset($options['transportOptions']);

        if (class_exists($className)) {
            $instance = new $className($serviceName);
            if (!$instance instanceof Service) {
                throw new InvalidArgumentException(
                    "Service class `{$className}` is not instance of `Yandex\\Direct\\Service`.",
                    self::E_INVALID_NAME
                );
            }
            $instance->setOptions($options);
            return $instance;
        }

        throw new InvalidArgumentException("Service class `{$className}` is not found.", self::E_INVALID_NAME);
    }

    /**
     * @param string $transportClass
     * @param array $transportOptions
     * @return TransportInterface
     * @throws InvalidArgumentException
     */
    protected function buildTransport($transportClass, array $transportOptions = [])
    {
        if (!class_exists($transportClass)) {
            throw new InvalidArgumentException("Transport class `{$transportClass}` is not found.", self::E_INVALID_OPTION);
        }

        $transport = new $transportClass;

        if (!$transport instanceof TransportInterface) {
            throw new InvalidArgumentException(
                "Transport class `{$transportClass}` is not instance of 
                `Yandex\\Direct\\Transport\\TransportInterface`",
                self::E_INVALID_OPTION
            );
        }

        $transport->setOptions($transportOptions);

        return $transport;
    }

    /**
     * @return string
     */
    protected function getServiceNamespace()
    {
        return __NAMESPACE__ . '\\' . 'Service';
    }
}
