<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 13:16
 */

namespace Yandex\Direct\Exception;

/**
 * Class TransportRequestException
 * @package Yandex\Direct\Exception
 */
class TransportRequestException extends RuntimeException
{
    /**
     * @var string
     */
    protected $requestHeaders;

    /**
     * @var string
     */
    protected $requestBody;

    /**
     * @var string
     */
    protected $responseHeaders;

    /**
     * @var string
     */
    protected $responseBody;

    /**
     * TransportRequestException constructor.
     *
     * @param string $message
     * @param int $code
     * @param array $requestHeaders
     * @param string $requestBody
     * @param array $responseHeaders
     * @param string $responseBody
     * @param \Exception|null|Exception $previous
     */
    public function __construct(
        $message,
        $code,
        $requestHeaders = [],
        $requestBody = '',
        $responseHeaders = [],
        $responseBody = '',
        \Exception $previous = null
    ) {
    
        $this->requestBody = $requestBody;
        $this->requestHeaders = $requestHeaders;
        $this->responseBody = $responseBody;
        $this->responseHeaders = $responseHeaders;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * @return string
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @return string
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }
}
