<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 11:28
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\TransportRequest;
use Yandex\Direct\Transport\TransportResponse;


/**
 * Class Service
 * @package Yandex\Direct
 */
abstract class Service implements ConfigurableInterface
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
     * @var Credentials
     */
    protected $credentials;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param Credentials $credentials
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param TransportResponse $response
     * @throws ErrorResponseException
     */
    protected static function handleErrorResponse(TransportResponse $response)
    {
        $json = json_decode($response->getBody(), true);

        if (isset($json['error'])
            && $json['error']
        ) {
            throw new ErrorResponseException(
                $json['error']['error_string'],
                $json['error']['error_detail'],
                $json['error']['error_code'],
                $json['error']['request_id']
            );
        }
    }

    /**
     * Do API request with needle headers
     *
     * @param array $params
     * @param bool $useOperatorUnits
     * @param array $headers
     * @return mixed
     */
    public function request(array $params, $useOperatorUnits = true, $headers = [])
    {
        $response = $this->transport->request(new TransportRequest([
            'service' => $this->name,
            'credentials' => $this->credentials,
            'params' => $params,
            'headers' => $headers,
            'useOperatorUnits' => $useOperatorUnits
        ]));

        self::handleErrorResponse($response);

        $result = json_decode($response->getBody(), true);

        $result['units'] = [
            'debit' => $response->getUnitsDebit(),
            'limit' => $response->getUnitsLimit(),
            'rest' => $response->getUnitsRest()
        ];

        $result['request_id'] = $response->getRequestId();

        return $result;
    }

}