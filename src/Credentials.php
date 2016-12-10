<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 19:48
 */

namespace Yandex\Direct;


/**
 * Class Credentials
 * @package Yandex\Direct\Credentials
 */
final class Credentials implements CredentialsInterface
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $masterToken;

    /**
     * @var string
     */
    protected $login;

    /**
     * Credentials constructor.
     *
     * @param string $login
     * @param string $token
     * @param string $masterToken
     */
    public function __construct($login = '', $token = '', $masterToken = '')
    {
        $this->login = $login;
        $this->token = $token;
        $this->masterToken = $masterToken;
    }

    /**
     * @return string
     */
    public function getMasterToken()
    {
        return $this->masterToken;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @param string $token
     * @param string $masterToken
     * @return Credentials
     */
    static public function buildCredentials($login = '', $token = '', $masterToken = '')
    {
        return new self($login, $token, $masterToken);
    }
}