<?php

use SafeBrowsing\Client;

require __DIR__ . '/../vendor/autoload.php';

echo '<pre>';

$guzzle = new \GuzzleHttp\Client();
$client = new Client($guzzle);
$client->setClientName('MyTestApp');
$client->setClientVersion('1.2.3');
$client->setApiKey('YOU_API_KEY');

var_dump($client->lookup('http://ianfette.org/'));

echo '</pre>';
