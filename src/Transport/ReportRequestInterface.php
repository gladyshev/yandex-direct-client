<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 30.03.17 14:02
 */

namespace Yandex\Direct\Transport;

interface ReportRequestInterface extends RequestInterface
{
    const PROCESSING_MODE_AUTO = 'auto';
    const PROCESSING_MODE_OFFLINE = 'offline';
    const PROCESSING_MODE_ONLINE = 'online';

    /**
     * The true value means that all moneys fields currency is YND_FIXED.
     *
     * @return bool
     */
    public function getReturnMoneyInMicros();

    /**
     * The mode of building reports.
     *
     * @return string
     */
    public function getProcessingMode();
}
