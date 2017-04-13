<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 13:44
 */

namespace Yandex\Direct\Transport;

use Yandex\Direct\ConfigurableTrait;
use Yandex\Direct\Exception\InvalidArgumentException;

/**
 * Class TransportRequest
 * @package Yandex\Direct
 */
class Response implements ResponseInterface
{
    use ConfigurableTrait;

    const UNITS_TYPE_DEBIT  = 0;
    const UNITS_TYPE_REST   = 1;
    const UNITS_TYPE_LIMIT  = 2;

    /**
     * Response constructor.
     *
     * @param array $responseAttributes
     */
    public function __construct(array $responseAttributes)
    {
        $this->setOptions($responseAttributes);
    }

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $units = [null, null, null];

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $code;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @return array
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @param string $rawUnits
     * @throws InvalidArgumentException
     */
    public function setUnits($rawUnits)
    {
        $units = explode('/', $rawUnits);
        if (is_array($units)
            && count($units) > 0
        ) {
            $this->units = $units;
        }
    }

    /**
     * @inheritdoc
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @inheritdoc
     */
    public function getUnitsDebit()
    {
        return $this->getUnits()[self::UNITS_TYPE_DEBIT];
    }

    /**
     * @inheritdoc
     */
    public function getUnitsRest()
    {
        return $this->getUnits()[self::UNITS_TYPE_REST];
    }

    /**
     * @inheritdoc
     */
    public function getUnitsLimit()
    {
        return $this->getUnits()[self::UNITS_TYPE_LIMIT];
    }

    /**
     * @inheritdoc
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @inheritdoc
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @inheritdoc
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return $this->headers;
    }

    public function getCode()
    {
        return $this->code;
    }
}
