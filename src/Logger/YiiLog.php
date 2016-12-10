<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 02.11.16 14:29
 */

namespace Yandex\Direct\Logger;

use Yii;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Class YiiLog. Works with Yii-framework environment only.
 *
 * @package Yandex\Direct\Logger
 */
class YiiLog extends AbstractLogger
{
    /**
     * @var string
     */
    private $category = '';

    /**
     * YiiLog constructor.
     * @param string $category
     */
    public function __construct($category = 'app')
    {
        $this->category = $category;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        Yii::log($message, $this->mapLevel($level), $this->category);
    }

    /**
     * @param $level
     * @return mixed
     */
    protected function mapLevel($level)
    {
        $map = [
            LogLevel::DEBUG => 'trace',
            LogLevel::WARNING => 'warning',
            LogLevel::ERROR => 'error',
            LogLevel::CRITICAL => 'error',
            LogLevel::NOTICE => 'warning',
            LogLevel::EMERGENCY => 'warning',
            LogLevel::ALERT => 'warning',
            LogLevel::INFO => 'info'
        ];

        return isset($map[$level]) ? $map[$level] : $level;
    }
}