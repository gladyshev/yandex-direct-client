<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 11:28
 */

namespace Yandex\Direct;

use LSS\XML2Array;
use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\RequestInterface;
use Yandex\Direct\Transport\ResponseInterface;
use Yandex\Direct\Transport\TransportInterface;

/**
 * Class Service
 * @package Yandex\Direct
 */
abstract class Service implements ServiceInterface
{
    use ConfigurableTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * @var array
     */
    protected $headers = [
        'Accept-Language' => RequestInterface::LANGUAGE_RU,
        'Use-Operator-Units' => 'true'
    ];


    /**
     * @inheritdoc
     * @throws ErrorResponseException
     * @throws \Throwable
     */
    public function request(array $params, array $headers = [])
    {
        /* Request API */

        $response = $this->getTransport()->request(new Request([
            'service' => $this->getName(),
            'credentials' => $this->getCredentials(),
            'params' => $params,
            'headers' => array_merge($this->headers, $headers),
        ]));

        switch ($response->getService()) {
            case TransportInterface::SERVICE_REPORTS:
                return $this->handleReportsResponse($response);

            default:
                return $this->handleResponse($response);
        }
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @inheritdoc
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /* Fluid setters */

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @param CredentialsInterface $credentials
     * @return $this
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param $useOperatorUnits
     * @return $this
     */
    public function setUseOperatorUnits($useOperatorUnits)
    {
        if (is_numeric($useOperatorUnits) || is_bool($useOperatorUnits)) {
            $useOperatorUnits = $useOperatorUnits ? 'true' : 'false';
        }
        $this->headers['Use-Operator-Units'] = $useOperatorUnits;
        return $this;
    }

    /**
     * @param $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->headers['Accept-Language'] = $language;
        return $this;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws ErrorResponseException
     */
    protected function handleResponse(ResponseInterface $response)
    {
        $result = json_decode($response->getBody(), true);

        /* Handle error response */

        if (isset($result['error'])
            && $result['error']
        ) {
            throw new ErrorResponseException(
                $result['error']['error_string'],
                $result['error']['error_detail'],
                $result['error']['error_code'],
                $result['error']['request_id']
            );
        }

        /* Prepare results */

        $result['units'] = [
            'debit' => $response->getUnitsDebit(),
            'limit' => $response->getUnitsLimit(),
            'rest' => $response->getUnitsRest()
        ];
        $result['request_id'] = $response->getRequestId();

        return $result;
    }

    /**
     * @param ResponseInterface $response
     * @return array|\DOMDocument
     * @throws ErrorResponseException
     * @throws \Throwable
     */
    protected function handleReportsResponse(ResponseInterface $response)
    {
        if ($response->getCode() >= 500) {
            $result = XML2Array::createArray($response->getBody());
            $result = $result['reports:reportDownloadError']['reports:ApiError'];
            throw new ErrorResponseException(
                $result['reports:errorMessage'],
                $result['reports:errorDetail'],
                $result['reports:errorCode'],
                $result['reports:requestId']
            );
        }

        $result = [
            'request_id' => $response->getRequestId()
        ];

        if ($response->getCode() == 201 || $response->getCode() == 202) {
            $result['retryIn'] = $response->getHeaders()['retryIn'];
            return $result;
        }

        $result['report'] = $response->getBody();

        return $result;
    }
}
