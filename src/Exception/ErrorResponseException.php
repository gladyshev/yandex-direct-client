<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @date 26/08/2016 14:24
 */

namespace Yandex\Direct\Exception;


/**
 * Class ErrorResponseException
 * @package Yandex\Direct\Exception
 */
class ErrorResponseException extends Exception
{
    /**
     * @var int
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $details;

    /**
     * @param string $message
     * @param string $details
     * @param int $code
     * @param int $requestId
     * @param \Exception $previous
     */
    public function __construct($message, $details = '', $code = 0, $requestId = 0, \Exception $previous = null)
    {
        $this->details = $details;
        $this->requestId = $requestId;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $str = 'Exception ' . __CLASS__ . " code {$this->code} with message '{$this->message}' in `{$this->file}`" . PHP_EOL;
        $str .= 'Details: ' . $this->details . PHP_EOL;
        $str .= 'Stack trace:' . PHP_EOL . $this->getTraceAsString();
        return $str;
    }
}