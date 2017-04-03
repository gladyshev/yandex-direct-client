<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 18:25
 */

namespace Yandex\Direct;

/**
 * Class CredentialsInterface
 * @package Yandex\Direct
 */
interface CredentialsInterface
{
    /**
     * @return string
     */
    public function getLogin();

    /**
     * @return string
     */
    public function getToken();

    /**
     * @return string
     */
    public function getMasterToken();
}
