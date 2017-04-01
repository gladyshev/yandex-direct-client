<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 13:42
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\ServiceNotFoundException;
use Yandex\Direct\Transport\TransportInterface;

/**
 * Class ServiceFactory
 *
 * @package Yandex\Direct
 */
class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createService(
        $serviceName,
        CredentialsInterface $credentials,
        TransportInterface $transport,
        array $serviceOptions = []
    )
    {
        $className = $this->getServiceNamespace() . '\\' . ucfirst($serviceName);
        if (class_exists($className)) {
            $instance = new $className($serviceName);
            if (!$instance instanceof Service) {
                throw new ServiceNotFoundException(
                    "Service class `{$className}` is not instance of `" . Service::class . "`."
                );
            }
            $serviceOptions['name'] = $serviceName;

            if (empty($serviceOptions['transport'])) {
                $serviceOptions['transport'] = $transport;
            }

            if (empty($serviceOptions['credentials'])) {
                $serviceOptions['credentials'] = $credentials;
            }

            $instance->setOptions($serviceOptions);

            return $instance;
        }

        throw new ServiceNotFoundException("Service class `{$className}` is not found.");
    }


    /**
     * @return string
     */
    protected function getServiceNamespace()
    {
        return __NAMESPACE__ . '\\' . 'Service';
    }
}
