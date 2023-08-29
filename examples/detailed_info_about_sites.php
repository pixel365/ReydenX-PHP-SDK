<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Order;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Order($client);
var_dump($o->setOrderId(12345)->sitesStats());
