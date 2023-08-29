<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\User;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new User($client);
var_dump($o->getBalance());
