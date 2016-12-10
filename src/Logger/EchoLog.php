<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 02.11.16 13:52
 */

namespace Yandex\Direct\Logger;


use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class EchoLog extends AbstractLogger
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        echo date("Y/m/d H:i:s") . " [{$level}] " . $message . PHP_EOL;
    }

}