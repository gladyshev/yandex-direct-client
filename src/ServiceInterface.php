<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 12.04.17 20:06
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\Exception;
use Yandex\Direct\Transport\TransportInterface;

interface ServiceInterface extends ConfigurableInterface
{
    /**
     * Returns Yandex Direct service name.
     *
     * @return string
     * @see https://tech.yandex.ru/direct/doc/dg/objects/objects-docpage/
     */
    public function getName();

    /**
     * @return CredentialsInterface
     */
    public function getCredentials();

    /**
     * @return TransportInterface
     */
    public function getTransport();

    /**
     * Request Yandex Direct API by Params and Headers.
     *
     * @param array $params
     * @param array $headers
     * @return array
     * @throws Exception
     */
    public function request(array $params, array $headers = []);


}