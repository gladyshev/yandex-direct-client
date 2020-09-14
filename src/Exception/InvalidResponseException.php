<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class InvalidResponseException extends \RuntimeException
{
    private $request;
    private $response;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        $message,
        $code = 0,
        \Throwable $previous = null
    ) {
        $this->request = $request;
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
