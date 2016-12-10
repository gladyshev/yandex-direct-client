<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 07.11.16 12:38
 */

use Psr\Log\NullLogger;
use Yandex\Direct\Client;
use Yandex\Direct\Credentials;

// Создаем и инициализируем инстанс клиента
$client = new Client(new Credentials('_LOGIN_', '_TOKEN_'));

// Вызовы сервисов и их методов очень удобны =)
$client->campaigns->get(['Ids' => [123456, 654321]], ['Funds']);

// Есть множество способов переконфигурировать библиотеку, например так:
$client->campaigns([
    'transport' => '\\Yandex\\Direct\\Transport\\JsonTransport',
    'transportSettings' => [
        'logger' => new NullLogger
    ]
])->get(['Ids' => [123456, 654321]], ['Funds']);

// Можно изменить доступы
$client->campaigns([
    'transport' => new Credentials('agrom', '0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f')
])->get(['Ids' => [123456, 654321]], ['Funds']);