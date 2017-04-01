<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 18:06
 */

namespace Yandex\Direct\Transport\Json;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Yandex\Direct\ConfigurableTrait;
use Yandex\Direct\Exception\RuntimeException;
use Yandex\Direct\Exception\TransportRequestException;
use Yandex\Direct\Transport\RequestInterface;
use Yandex\Direct\Transport\Response;
use Yandex\Direct\Transport\TransportInterface;

/**
 * Class JsonTransport
 * @package Yandex\Direct\Transport
 */
class Transport implements TransportInterface, LoggerAwareInterface
{
    use ConfigurableTrait;

    /**
     * @var string
     */
    private $baseUrl = 'https://api.direct.yandex.com';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * Custom Service urls
     * @var array
     */
    private $serviceUrls = [];

    /**
     * @var array
     */
    private $headers = [
        'Content-Type' => 'application/json; charset=utf-8'
    ];

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var MessageFormatter
     */
    private $logMessageFormatter;

    /**
     * JsonTransport constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @inheritdoc
     */
    public function getServiceUrl($serviceName)
    {
        if (isset($this->serviceUrls[$serviceName])) {
            // If service url is absolute
            if (preg_match('#http[s]*://#u', $this->serviceUrls[$serviceName])) {
                return $this->serviceUrls[$serviceName];
            }
            return $this->baseUrl . $this->serviceUrls[$serviceName];
        }

        return $this->baseUrl . '/json/v5/' . strtolower($serviceName);
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param RequestInterface $request
     * @return Response
     * @throws RuntimeException
     * @throws TransportRequestException
     */
    public function request(RequestInterface $request)
    {
        try {
            $client = $this->getHttpClient();

            $httpResponse = $client->request('POST', $this->getServiceUrl($request->getService()), [
                'headers' => $this->prepareHeaders($request),
                'body' => $this->prepareBody($request)
            ]);

            $httpResponseHeaders = $httpResponse->getHeaders();

            return new Response([
                'headers' => $httpResponse->getHeaders(),
                'body' => $httpResponse->getBody()->__toString(),
                'requestId' => isset($httpResponseHeaders['RequestId']) ? current($httpResponseHeaders['RequestId']) : null,
                'units' => isset($httpResponseHeaders['Units']) ? current($httpResponseHeaders['Units']) : null
            ]);
        } catch (RequestException $e) {
            $this->getLogger()->error("Transport error: {$e->getMessage()} [CODE: {$e->getCode()}]");
            throw new TransportRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e->getRequest()->getHeaders(),
                $e->getRequest()->getBody()->__toString(),
                $e->hasResponse() ? $e->getResponse()->getHeaders() : [],
                $e->hasResponse() ? $e->getResponse()->getBody()->__toString() : '',
                $e->getPrevious()
            );
        } catch (\Exception $e) {
            $this->getLogger()->error("Runtime error: {$e->getMessage()} [CODE: {$e->getCode()}]");
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    /**
     * @return ClientInterface
     */
    private function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new Client([
                'base_uri' => $this->baseUrl,
                'handler' => $this->getHttpHandlers()
            ]);
        }
        return $this->httpClient;
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        // Use stub if logger is not initialized
        if ($this->logger === null) {
            $this->logger = new NullLogger;
        }
        return $this->logger;
    }

    /**
     * @return MessageFormatter
     */
    private function getMessageFormatter()
    {
        if ($this->logMessageFormatter === null) {
            $this->logMessageFormatter = new MessageFormatter(MessageFormatter::DEBUG);
        }
        return $this->logMessageFormatter;
    }

    /**
     * @return HandlerStack
     */
    private function getHttpHandlers()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::log(
            $this->getLogger(),
            $this->getMessageFormatter()
        ));
        return $stack;
    }

    /**
     * @param Request | RequestInterface $request
     * @return array
     */
    private function prepareHeaders(RequestInterface $request)
    {
        $headers = array_merge([
            'Authorization' => 'Bearer ' . $request->getCredentials()->getToken(),
            'Client-Login' => $request->getCredentials()->getLogin(),
            'Accept-Language' => $request->getLanguage(),
        ], $this->headers);

        if ($request->getUseOperatorUnits()) {
            $headers['Use-Operator-Units'] = 'true';
        }

        if ($request->getService() == 'AgencyClients') {
            unset($headers['Client-Login']);
        }

        return $headers;
    }

    /**
     * @param Request | RequestInterface $request
     * @return string
     */
    private function prepareBody(RequestInterface $request)
    {
        return json_encode(
            array_merge(['method' => $request->getMethod()], $request->getParams()),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );
    }
}
