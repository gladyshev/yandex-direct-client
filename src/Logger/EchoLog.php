<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 02.11.16 13:52
 */

namespace Yandex\Direct\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Psr\Log\InvalidArgumentException;

/**
 * Class EchoLog
 * @package Yandex\Direct\Logger
 */
class EchoLog extends AbstractLogger
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @throws InvalidArgumentException
     */
    public function log($level, $message, array $context = [])
    {
        if (!$this->checkLevel($level)) {
            throw new InvalidArgumentException("Invalid log level {$level}");
        }
        echo "[$level] $message" . PHP_EOL;
    }

    private function checkLevel($level)
    {
        if (in_array($level, [
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::WARNING,
            LogLevel::DEBUG,
            LogLevel::INFO,
            LogLevel::NOTICE,
        ])) {
            return true;
        }
        return false;
    }
}
