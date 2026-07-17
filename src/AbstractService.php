<?php

namespace Gladyshev\Yandex\Direct;

use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use StdClass;

abstract class AbstractService implements ServiceInterface
{
    public function __construct(
        private readonly string $serviceName,
        private readonly CredentialsInterface $credentials,
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory
    ) {
    }

    #[\Override]
    public function call(array $params = []): array
    {
        $request = $this->requestFactory
            ->createRequest('POST', $this->getUri())
            ->withBody($this->streamFactory->createStream($this->getBody($params)));

        foreach ($this->getHeaders() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        $response = $this->httpClient->sendRequest($request);

        return $this->handleResponse($request, $response);
    }

    protected function getServiceName(): string
    {
        return $this->serviceName;
    }

    protected function getCredentials(): CredentialsInterface
    {
        return $this->credentials;
    }

    protected function getUri(): string
    {
        return $this->getCredentials()->getBaseUrl() . '/json/v5/' . mb_strtolower($this->getServiceName());
    }

    protected function getHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getCredentials()->getToken(),
            'Accept-Language' => $this->getCredentials()->getLanguage()
        ];

        if ($this->getCredentials()->isAgency()) {
            $headers['Use-Operator-Units'] = $this->getCredentials()->getUseOperatorUnits() ? 'true' : 'false';
            if ($this->getCredentials()->getClientLogin()) {
                $headers['Client-Login'] = $this->getCredentials()->getClientLogin();
            }
        }

        return $headers;
    }

    /**
     * @return false|string
     */
    protected function getBody(array $params): string|false
    {
        if (empty($params['params'])) {
            $params = new StdClass();
        } else {
            $params['params'] = array_filter($params['params']);
        }

        return json_encode($params);
    }

    protected function handleResponse(
        RequestInterface $request,
        ResponseInterface $response
    ): array {
        $contents = $response->getBody()->__toString();
        $parsedBody = json_decode($contents, true);

        if (!is_array($parsedBody)) {
            throw new ErrorResponseException(
                'Unexpected API response.',
                $contents,
                0,
                $request,
                $response
            );
        }

        if (!empty($parsedBody['error'])) {
            throw new ErrorResponseException(
                $parsedBody['error']['error_string'],
                $parsedBody['error']['error_detail'],
                (int) $parsedBody['error']['error_code'],
                $request,
                $response
            );
        }

        $unitsUsedLogin = current($response->getHeader('Units-Used-Login'));

        $requestId = current($response->getHeader('RequestId'));

        [$debit, $rest, $limit] = explode('/', current($response->getHeader('Units')));

        return [
            'request_id' => $requestId,
            'units' => [
                'debit' => $debit,
                'rest' => $rest,
                'limit' => $limit
            ],
            'units_used_login' => $unitsUsedLogin,
            'result' => $parsedBody['result'] ?? $parsedBody
        ];
    }
}
