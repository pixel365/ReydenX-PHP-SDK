<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Order;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Order($client);
$res = $o->getList();
foreach ($res->result as $order) {
    if ($order instanceof \ReydenX\V1\Model\Order) {
        var_dump($order);
    }
}
