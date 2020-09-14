<?php
declare(strict_types=1);

namespace Gladyshev\Yandex\Direct;

abstract class AbstractService implements \Gladyshev\Yandex\Direct\ServiceInterface
{
    /**
     * @var \Gladyshev\Yandex\Direct\CredentialsInterface
     */
    protected $credentials;

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    protected $httpClient;

    /**
     * @var bool
     */
    protected $throwExceptionOnError = true;

    public function __construct(
        \Gladyshev\Yandex\Direct\CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    ) {
        $this->credentials = $credentials;
        $this->httpClient = $httpClient;
    }

    public function getName(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    /**
     * @param array|null $params
     * @return array
     * @throws \Throwable
     */
    public function call(array $params = [])
    {
        if (empty($params)) {
            $params = new \StdClass;
        }

        $request = new \GuzzleHttp\Psr7\Request(
            'POST',
            $this->getUri(),
            $this->getHeaders(),
            $this->prepareBody($params)
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->handleResponse($response, $request);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\RequestInterface $request
     * @return array
     * @throws \Throwable
     */
    protected function handleResponse(
        \Psr\Http\Message\ResponseInterface $response,
        \Psr\Http\Message\RequestInterface $request
    ): array {
        if ($response->getStatusCode() != 200) {
            throw new \Gladyshev\Yandex\Direct\Exception\InvalidResponseException(
                $request,
                $response,
                'Unexpected response.'
            );
        }

        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['error']) && $result['error']) {
            throw new \Gladyshev\Yandex\Direct\Exception\ErrorResponseException(
                $result['error']['error_string'],
                $result['error']['error_detail'],
                $result['error']['error_code'],
                $request,
                $response
            );
        }

        $result['request_id'] = current($response->getHeader('RequestId'));

        if ($response->getHeader('Units')) {
            [$debit, $rest, $limit] = explode('/', current($response->getHeader('Units')));
            $result['units'] = [
                'debit' => $debit ?? null,
                'limit' => $limit ?? null,
                'rest'  => $rest?? null
            ];

            $request['unitsUsedLogin'] = current($response->getHeader('Units-Used-Login'));
        }

        return $result;
    }

    protected function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->credentials->getToken(),
            'Client-Login' => $this->credentials->getLogin(),
            'Accept-Language' => $this->credentials->getLanguage(),
            'Use-Operator-Units' => $this->credentials->getUseOperatorUnits() ? 'true' : 'false'
        ];
    }

    protected function prepareBody(array $params): string
    {
        return json_encode(
            $params,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );
    }

    public function getUri(): string
    {
        return $this->credentials->getBaseUrl() . '/json/v5/' . mb_strtolower($this->getName());
    }
}
