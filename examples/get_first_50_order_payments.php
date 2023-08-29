<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Model\Payment;
use ReydenX\V1\Order;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$o = new Order($client);
$res = $o->payments();
foreach ($res->result as $payment) {
    if ($payment instanceof Payment) {
        var_dump($payment);
    }
}
