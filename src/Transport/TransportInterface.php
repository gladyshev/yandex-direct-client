<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 16/08/2016 20:58
 */

namespace Yandex\Direct\Transport;

/**
 * Interface TransportInterface
 * @package Yandex\Direct\Transport
 */
interface TransportInterface
{
    const SERVICE_REPORTS = 'Reports';
    const SERVICE_AGENCY_CLIENTS = 'AgencyClients';

    /**
     * Request API.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function request(RequestInterface $request);
}
