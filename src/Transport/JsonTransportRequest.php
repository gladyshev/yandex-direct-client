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
class JsonTransportRequest implements RequestInterface
{
    use ConfigurableTrait;

    /**
     * @var bool
     */
    protected $useOperatorUnits = true;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $language = self::LANGUAGE_RU;

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

    /**
     * @inheritdoc
     */
    public static function fromArray(array $request)
    {
        return new self($request);
    }


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
        $this->useOperatorUnits = $useOperatorUnits;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @inheritdoc
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
