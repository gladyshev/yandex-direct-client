<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 18:06
 */

namespace Yandex\Direct\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Yandex\Direct\ConfigurableTrait;
use Yandex\Direct\Exception\RuntimeException;
use Yandex\Direct\Exception\TransportRequestException;


/**
 * Class JsonTransport
 * @package Yandex\Direct\Transport
 */
final class JsonTransport implements TransportInterface, LoggerAwareInterface
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
    private $headers = [];

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $language = 'ru';

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
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function request(TransportRequest $request)
    {
        $log = $this->getLogger();

        try {
            $client = $this->getHttpClient();
            /*
             * Build http request by transport request
             */
            $httpRequest = $client->createRequest('POST', $this->getServiceUrl($request->getService()), [
                'headers' => $this->prepareHeaders($request),
                'body' => $this->prepareBody($request)
            ]);

            /*
             * Requesting API with logging
             */
            $log->debug("[request] " . $this->formatBodyLog($httpRequest->__toString()));

            $httpResponse = $client->send($httpRequest);

            $log->debug("[response] " . $this->formatBodyLog($httpResponse->__toString()));

            $httpResponseHeaders = $httpResponse->getHeaders();


            return new TransportResponse([
                'headers' => $httpResponse->getHeaders(),
                'body' => $httpResponse->getBody()->__toString(),
                'requestId' => isset($httpResponseHeaders['RequestId']) ? current($httpResponseHeaders['RequestId']) : null,
                'units' => isset($httpResponseHeaders['Units']) ? current($httpResponseHeaders['Units']) : null
            ]);

        } catch (RequestException $e) {
            $log->error("Transport error: {$e->getMessage()} [CODE: {$e->getCode()}]");
            throw new TransportRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e->getRequest()->getHeaders(),
                $e->getRequest()->getBody(),
                $e->hasResponse() ? $e->getResponse()->getHeaders() : [],
                $e->hasResponse() ? $e->getResponse()->getBody() : '',
                $e->getPrevious()
            );
        } catch (\Exception $e) {
            $log->error("Runtime error: {$e->getMessage()} [CODE: {$e->getCode()}]");
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
                'baseUrl' => $this->baseUrl
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
     * @param TransportRequest $request
     * @return array
     */
    private function prepareHeaders(TransportRequest $request)
    {
        return array_merge([
            'Authorization' => 'Bearer ' . $request->getCredentials()->getToken(),
            'Client-Login' => $request->getCredentials()->getLogin(),
            'Use-Operator-Units' => $request->getUseOperatorUnits(),
            'Accept-Language' => $this->language,
            'Content-Type' => 'application/json; charset=utf-8'
        ], $this->headers);
    }

    /**
     * @param TransportRequest $request
     * @return string
     */
    private function prepareBody(TransportRequest $request)
    {
        return json_encode(
            array_merge([
                'method' => $request->getMethod(),
            ], $request->getParams()),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );
    }

    /**
     * @param $message
     * @return string
     */
    private function formatBodyLog($message)
    {
        return "\n---\n{$message}\n---\n";
    }
}