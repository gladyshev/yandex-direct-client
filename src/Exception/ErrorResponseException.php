<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct\Exception;

class ErrorResponseException extends \RuntimeException
{
    public function __construct(
        string $message,
        protected readonly string $detail,
        int $code,
        protected readonly \Psr\Http\Message\RequestInterface $request,
        protected readonly \Psr\Http\Message\ResponseInterface $response,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getRequest(): \Psr\Http\Message\RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    public function __toString(): string
    {
        $str = 'Exception ' . __CLASS__ . " code {$this->code} with message '{$this->message}' in `{$this->file}`" . PHP_EOL;
        $str .= 'Details: ' . $this->detail . PHP_EOL;
        $str .= 'Stack trace:' . PHP_EOL . $this->getTraceAsString() . PHP_EOL;
        $str .= 'Request-Response:' . PHP_EOL;
        $str .= '>>>' . $this->messageToString($this->getRequest()) . PHP_EOL;
        $str .= '<<<' . $this->messageToString($this->getResponse()) . PHP_EOL;

        return $str;
    }

    private function messageToString(\Psr\Http\Message\MessageInterface $message): string
    {
        $str = match (true) {
            $message instanceof \Psr\Http\Message\RequestInterface => $this->requestStartLine($message),
            $message instanceof \Psr\Http\Message\ResponseInterface => $this->responseStartLine($message),
            default => throw new \InvalidArgumentException('Unknown message type.'),
        };

        foreach ($message->getHeaders() as $name => $values) {
            $str .= "\r\n" . $name . ': ' . implode(', ', $values);
        }

        return $str . "\r\n\r\n" . $message->getBody();
    }

    private function requestStartLine(\Psr\Http\Message\RequestInterface $request): string
    {
        $str = "{$request->getMethod()} {$request->getRequestTarget()} HTTP/{$request->getProtocolVersion()}";

        if (!$request->hasHeader('host')) {
            $str .= "\r\nHost: " . $request->getUri()->getHost();
        }

        return $str;
    }

    private function responseStartLine(\Psr\Http\Message\ResponseInterface $response): string
    {
        return "HTTP/{$response->getProtocolVersion()} {$response->getStatusCode()} {$response->getReasonPhrase()}";
    }
}
