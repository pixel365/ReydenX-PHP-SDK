<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Action;
use ReydenX\V1\Client;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Action($client);
var_dump($o->setOrderId(12345)->cancel());
