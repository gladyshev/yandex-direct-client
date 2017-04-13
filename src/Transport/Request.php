<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 13:52
 */

namespace Yandex\Direct\Transport;

use Yandex\Direct\ConfigurableTrait;
use Yandex\Direct\CredentialsInterface;

/**
 * Class TransportRequest
 * @package Yandex\Direct
 */
class Request implements RequestInterface
{
    use ConfigurableTrait;

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
     * @var array
     */
    protected $headers = [];

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * Request constructor.
     * @param array $requestAttributes
     */
    public function __construct(array $requestAttributes = [])
    {
        $this->setOptions($requestAttributes);
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
     * @inheritdoc
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @inheritdoc
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
