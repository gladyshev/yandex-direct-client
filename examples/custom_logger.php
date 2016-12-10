<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 07.11.16 12:45
 */

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Psr\Log\AbstractLogger;
use Yandex\Direct\Transport\JsonTransport;

/**
 * Simple psr-3 logger
 * Class MyLogger
 */
class MyLogger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        echo "[$level] $message\n";
    }
}

$transport = new JsonTransport;
$transport->setLogger(new MyLogger);

$client = new Client(new Credentials('_LOGIN_', '_TOKEN_'), [
    'transport' => $transport
]);

$client->campaigns->get(['Ids' => [123456, 654321]], ['Status']);