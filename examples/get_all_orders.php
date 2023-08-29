<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Order;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Order($client);
$hasNext = true;
$cursor = null;
while ($hasNext) {
    $res = $o->getList($cursor);
    $hasNext = $res->hasNext();
    $cursor = $res->cursor;
    foreach ($res->result as $order) {
        if ($order instanceof \ReydenX\V1\Model\Order) {
            var_dump($order);
        }
    }
}
