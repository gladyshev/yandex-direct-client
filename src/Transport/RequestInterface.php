<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 11:54
 */

namespace Yandex\Direct\Transport;

use Yandex\Direct\CredentialsInterface;

/**
 * Interface RequestInterface
 * @package Yandex\Direct\Transport
 */
interface RequestInterface
{
    const LANGUAGE_RU = 'ru';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_TR = 'tr';
    const LANGUAGE_UK = 'uk';

    const PROCESSING_MODE_AUTO = 'auto';
    const PROCESSING_MODE_OFFLINE = 'offline';
    const PROCESSING_MODE_ONLINE = 'online';

    /**
     * API service name.
     *
     * @return string
     */
    public function getService();

    /**
     * Method name of service.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Request payload.
     *
     * @return array
     */
    public function getParams();

    /**
     * Credentials for transport authorization.
     *
     * @return CredentialsInterface
     */
    public function getCredentials();

    /**
     * Yandex additional headers.
     *
     * @return array
     */
    public function getHeaders();
}
