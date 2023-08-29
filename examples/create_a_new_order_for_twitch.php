<?php

require __DIR__ . '/../vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Model\LaunchMode;
use ReydenX\V1\Model\NewOrderParams;
use ReydenX\V1\Model\Platform;
use ReydenX\V1\Model\SmothGain;
use ReydenX\V1\Order;


$client = new Client('EMAIL', 'PASSWORD');
$client->auth();

$params = new NewOrderParams([
    'platform' => Platform::Twitch,
    'price_id' => 123,
    'number_of_views' => 10000,
    'number_of_viewers' => 100,
    'launch_mode' => LaunchMode::Auto,
    'smooth_gain' => new SmothGain(false, 0),
    'delay_time' => 0,
    'twitch_id' => 123456,
]);

$o = new Order($client);
$o->create($params);
