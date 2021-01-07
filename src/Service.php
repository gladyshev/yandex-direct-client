<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 11:28
 */

namespace Yandex\Direct;

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
        'Accept-Language' => RequestInterface::LANGUAGE_RU
    ];


    /**
     * @inheritdoc
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function request(array $params, array $headers = [])
    {
        $params['params'] = filter_params($params['params']);

        /* Request API */

        $response = $this->getTransport()->request(new Request([
            'service' => $this->getName(),
            'credentials' => $this->getCredentials(),
            'params' => $params,
            'headers' => array_merge($this->headers, $headers),
        ]));

        return $this->handleResponse($response);
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
        if (is_bool($useOperatorUnits)) {
            $this->headers['Use-Operator-Units'] = $useOperatorUnits ? 'true' : 'false';
        }

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
}
