<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 07.11.16 12:38
 */

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;

$client = Client::build(getenv('_LOGIN_'), getenv('_TOKEN_'));

// just...
$resp = $client->campaigns->get(['Types' => ['TEXT_CAMPAIGN']], ['Funds']);

print_r($resp);