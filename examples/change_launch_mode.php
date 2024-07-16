<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Action;
use ReydenX\V1\Client;
use ReydenX\V1\Model\LaunchMode;

$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Action($client);
$o->setOrderId(12345);

var_dump($o->changeLaunchMode(LaunchMode::Auto, 0));
var_dump($o->changeLaunchMode(LaunchMode::Manual, 0));
var_dump($o->changeLaunchMode(LaunchMode::Delay, 15));
