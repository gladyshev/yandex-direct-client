<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 10.12.16 16:10
 */

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;
use Yandex\Direct\Transport\JsonTransport;

$credentials = new Credentials('_LOGIN_', '_TOKEN_');

$options['transport'] = new JsonTransport;
$options['transport']->setOptions([
    'baseUrl' => 'https://api-sandbox.direct.yandex.com',
    'logger' => new EchoLog
]);

$client = new Client($credentials, $options);

$client->campaigns->get(['Ids' => [123456, 654321]], ['Funds']);