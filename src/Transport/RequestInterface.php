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

    /**
     * Build instance of request by array.
     *
     * @param array $request
     * @return RequestInterface
     */
    public static function fromArray(array $request);

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
     * @return array
     */
    public function getParams();

    /**
     * @return bool
     */
    public function getUseOperatorUnits();

    /**
     * @return CredentialsInterface
     */
    public function getCredentials();

    /**
     * Language of response messages.
     *
     * @return string
     */
    public function getLanguage();
}
