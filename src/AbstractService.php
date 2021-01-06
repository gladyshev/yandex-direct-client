<?php

declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

abstract class AbstractService implements ServiceInterface
{
    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var \Gladyshev\Yandex\Direct\CredentialsInterface
     */
    private $credentials;

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    private $httpClient;

    public function __construct(
        string $serviceName,
        \Gladyshev\Yandex\Direct\CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    ) {
        $this->serviceName = $serviceName;
        $this->credentials = $credentials;
        $this->httpClient = $httpClient;
    }

    public function call(array $params = []): array
    {
        $request = new \GuzzleHttp\Psr7\Request(
            'POST',
            $this->getUri(),
            $this->getHeaders(),
            $this->getBody($params)
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->handleResponse($request, $response);
    }

    protected function getServiceName(): string
    {
        return $this->serviceName;
    }

    protected function getCredentials(): \Gladyshev\Yandex\Direct\CredentialsInterface
    {
        return $this->credentials;
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return $this->getCredentials()->getBaseUrl() . '/json/v5/' . mb_strtolower($this->getServiceName());
    }

    /**
     * @return array
     */
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
     * @param array $params
     * @return string
     */
    protected function getBody(array $params): string
    {
        if (empty($params['params'])) {
            $params = new \StdClass();
        } else {
            $params['params'] = array_filter($params['params']);
        }

        return json_encode($params);
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array
     */
    protected function handleResponse(
        \Psr\Http\Message\RequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response
    ): array {
        $result = json_decode($response->getBody()->getContents(), true);

        /* Handle error response */

        if (isset($result['error']) && $result['error']) {
            throw new \Gladyshev\Yandex\Direct\Exception\ErrorResponseException(
                $result['error']['error_string'],
                $result['error']['error_detail'],
                (int) $result['error']['error_code'],
                $request,
                $response
            );
        }

        $requestId = current($response->getHeader('RequestId'));

        [$debit, $rest, $limit] = explode('/', current($response->getHeader('Units')));

        return [
            'request_id' => $requestId,
            'units' => [
                'debit' => $debit,
                'rest' => $rest,
                'limit' => $limit
            ],
            'result' => $result
        ];
    }
}
