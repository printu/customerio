<?php

include_once 'vendor/autoload.php';

$config = [
    'api_key' => '121',
    'site_id' => '2323'
];

$client = new \Customerio\Events($config);

$client->add();