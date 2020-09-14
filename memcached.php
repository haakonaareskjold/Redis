<?php
require_once __DIR__. "/vendor/autoload.php";

$client = new Predis\Client();
$client->set('foo', 'bar');
$value = $client->get('foo');
print_r($value);