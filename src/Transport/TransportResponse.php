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
class TransportResponse
{
    use ConfigurableTrait;

    const UNITS_TYPE_DEBIT = 0;
    const UNITS_TYPE_REST = 1;
    const UNITS_TYPE_LIMIT = 2;

    /**
     * TransportResponse constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

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
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return int
     */
    public function getUnitsDebit()
    {
        return $this->getUnits()[self::UNITS_TYPE_DEBIT];
    }

    /**
     * @return int
     */
    public function getUnitsRest()
    {
        return $this->getUnits()[self::UNITS_TYPE_REST];
    }

    /**
     * @return int
     */
    public function getUnitsLimit()
    {
        return $this->getUnits()[self::UNITS_TYPE_LIMIT];
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * The keys represent the header name as it will be sent over the wire, and
     * each value is an array of strings associated with the header.
     *
     *     // Represent the headers as a string
     *     foreach ($message->getHeaders() as $name => $values) {
     *         echo $name . ": " . implode(", ", $values);
     *     }
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
