<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 17/08/2016 11:28
 */

namespace Yandex\Direct;

use Yandex\Direct\Exception\ErrorResponseException;
use Yandex\Direct\Transport\Request;
use Yandex\Direct\Transport\TransportInterface;

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
     * @throws ErrorResponseException
     */
    public function request(array $params, $headers = [])
    {
        /* Request API */

        $request = new Request([
            'service' => $this->name,
            'credentials' => $this->credentials,
            'params' => $params,
            'headers' => $headers,
            'useOperatorUnits' => $this->useOperatorUnits
        ]);
        $response = $this->transport->request($request);
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
