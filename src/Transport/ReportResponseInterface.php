<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 14:02
 */

namespace Yandex\Direct\Transport;

interface ReportResponseInterface extends ResponseInterface
{
    /**
     * Returns recommend offline reports next call timeout in seconds.
     *
     * @return int
     */
    public function getRetryIn();
}
