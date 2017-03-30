<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 11:54
 */

namespace Yandex\Direct\Transport;


use Yandex\Direct\CredentialsInterface;

interface TransportRequestInterface
{
    /**
     * @return string
     */
    public function getService();

    /**
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
     * @return bool
     */
    public function getLanguage();
}