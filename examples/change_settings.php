<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 10.12.16 16:49
 */

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;

$client = new Client(new Credentials('_LOGIN_', '_TOKEN_'));

// Меняем логгер
$client->campaigns([
    'transport' => '\\Yandex\\Direct\\Transport\\JsonTransport',
    'transportSettings' => [
        'logger' => new EchoLog
    ]
])->get(['Ids' => [123456, 654321]], ['Funds']);

// Можно изменить доступы
$client->campaigns([
    'transport' => new Credentials('agrom', '0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f')
])->get(['Ids' => [123456, 654321]], ['Funds']);