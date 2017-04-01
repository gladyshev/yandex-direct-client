<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 11:28
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Exception\RuntimeException;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\TransportInterface;
use Yandex\Direct\Transport\ResponseInterface;

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
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * @var bool
     */
    private $useOperatorUnits = true;

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
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param CredentialsInterface $credentials
     */
    public function setCredentials(CredentialsInterface $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param bool $useOperatorUnits
     */
    public function setUseOperatorUnits($useOperatorUnits)
    {
        $this->useOperatorUnits = $useOperatorUnits;
    }

    /**
     * Do API request with needle headers
     *
     * @param array $params
     * @param array $headers
     * @return array
     * @throws RuntimeException
     */
    public function request(array $params, $headers = [])
    {
        $response = $this->transport->request(new Request([
            'service' => $this->name,
            'credentials' => $this->credentials,
            'params' => $params,
            'headers' => $headers,
            'useOperatorUnits' => $this->useOperatorUnits
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

    /**
     * @param ResponseInterface $response
     * @throws ErrorResponseException
     */
    protected static function handleErrorResponse(ResponseInterface $response)
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
}
