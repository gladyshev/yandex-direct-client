<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Exception;

class ErrorResponseException extends \RuntimeException
{
    /**
     * @var string
     */
    protected $detail;

    /**
     * @var \Psr\Http\Message\RequestInterface
     */
    protected $request;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $error = [];

    public function __construct(
        $message,
        $detail,
        $code,
        \Psr\Http\Message\RequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response,
        \Throwable $previous = null
    ) {
        $this->detail = $detail;
        $this->request = $request;
        $this->response = $response;

        parent::__construct(
            $message,
            $code,
            $previous
        );
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest(): \Psr\Http\Message\RequestInterface
    {
        return $this->request;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $str = 'Exception ' . __CLASS__ . " code {$this->code} with message '{$this->message}' in `{$this->file}`" . PHP_EOL;
        $str .= 'Details: ' . $this->detail . PHP_EOL;
        $str .= 'Stack trace:' . PHP_EOL . $this->getTraceAsString();
        return $str;
    }
}
