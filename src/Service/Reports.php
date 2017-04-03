<?php

namespace Yandex\Direct\Service;

use Yandex\Direct\Service;
use Yandex\Direct\Transport\ReportRequestInterface;

/**
 * Class Reports
 *
 * @author Dmitry Gladyshev <deel@email.ru>
 */
final class Reports extends Service
{
    protected $processingMode = ReportRequestInterface::PROCESSING_MODE_AUTO;

    /**
     * @param $mode
     * @return $this
     */
    public function setProcessingMode($mode)
    {
        $this->processingMode = $mode;
        return $this;
    }
}
