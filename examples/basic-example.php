<?php

use SafeBrowsing\Client;

require __DIR__ . '/../vendor/autoload.php';

$client = new Client(
    'MyTestApp',
    '1.2.3',
    '123123123'
);
