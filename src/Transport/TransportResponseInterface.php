<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 11:54
 */

namespace Yandex\Direct\Transport;


interface TransportResponseInterface
{
    /**
     * @return string
     */
    public function getRequestId();

    /**
     * Returns api units debit of request.
     *
     * @return int
     */
    public function getUnitsDebit();

    /**
     * Returns the rest of API units.
     *
     * @return int
     */
    public function getUnitsRest();

    /**
     * Returns API units limit.
     *
     * @return int
     */
    public function getUnitsLimit();

    /**
     * Returns the raw body of http request.
     *
     * @return string
     */
    public function getBody();

    /**
     * The keys represent the header name as it will be sent over the wire, and
     * each value is an array of strings associated with the header.
     *
     *     // Represent the headers as a string
     *     foreach ($message->getHeaders() as $name => $values) {
     *         echo $name . ": " . implode(", ", $values);
     *     }
     *
     * @return array
     */
    public function getHeaders();
}