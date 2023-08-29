<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Model\Platform;
use ReydenX\V1\Prices;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Prices($client);
var_dump($o->getPrices(Platform::Twitch));
