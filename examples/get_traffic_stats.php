<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Traffic;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Traffic($client);
var_dump($o->getCountries());
var_dump($o->getLanguages());
var_dump($o->getDevices());
