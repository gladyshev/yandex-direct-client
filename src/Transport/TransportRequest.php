<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 13:52
 */

namespace Yandex\Direct\Transport;

use Yandex\Direct\ConfigurableTrait;
use Yandex\Direct\CredentialsInterface;
use Yandex\Direct\Exception\InvalidArgumentException;


/**
 * Class TransportRequest
 * @package Yandex\Direct
 */
class TransportRequest
{
    use ConfigurableTrait;

    /**
     * @var string
     */
    protected $useOperatorUnits = 'true';

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Custom headers
     * @var array
     */
    protected $headers = [];

    /**
     * @var CredentialsInterface
     */
    protected $credentials;


    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getUseOperatorUnits()
    {
        return $this->useOperatorUnits;
    }

    /**
     * @param bool $useOperatorUnits
     * @throws InvalidArgumentException
     */
    public function setUseOperatorUnits($useOperatorUnits)
    {
        if (is_numeric($useOperatorUnits) || is_bool($useOperatorUnits)) {
            $this->useOperatorUnits = $useOperatorUnits ? 'true' : 'false';
        } else {
            if (!in_array($useOperatorUnits, ['true', 'false'])) {
                throw new InvalidArgumentException("Invalid value `\$seOperatorUnits`, valid is boolean and `true` or `false`.");
            }
            $this->useOperatorUnits = $useOperatorUnits;
        }
    }

     /**
     * @return CredentialsInterface
     */
    public function getCredentials()
    {
        return $this->credentials;
    }


}