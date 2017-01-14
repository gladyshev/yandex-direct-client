<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 23/08/2016 18:25
 */

namespace Yandex\Direct;

/**
 * Class CredentialsInterface
 * @package Yandex\Direct\Credentials
 */
interface CredentialsInterface
{
    /**
     * @return string
     */
    public function getMasterToken();


    /**
     * @return string
     */
    public function getToken();


    /**
     * @return string
     */
    public function getLogin();
}
