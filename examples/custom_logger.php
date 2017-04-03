<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 07.11.16 12:45
 */

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Psr\Log\AbstractLogger;
use Yandex\Direct\Transport\Json\Transport;

// Custom psr-3 logger
class MyLogger extends AbstractLogger {
    public function log($level, $message, array $context = array()) { echo "[$level] $message\n"; }
}

$client = new Client(
    new Credentials(getenv('_LOGIN_'), getenv('_TOKEN_')),
    new Transport(['logger' => new MyLogger])
);

$resp = $client->campaigns->get(['Ids' => [123456, 654321]], ['Status']);

print_r($resp);