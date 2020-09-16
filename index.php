<?php

// composer autoload
require_once __DIR__. "/vendor/autoload.php";

// print out log row with current count of request to stdout
if(!defined('STDOUT')) define('STDOUT', fopen('php://stdout', 'w'));

// imports Predis
$counter = new Predis\Client('tcp://192.168.0.1:6379');

// checks if key 'counter' exists, if not sets value to 0
if(!$counter->exists('counter')) {
    $counter->set('counter',  0);
}

// checks if request method for server is get, if it is, it will increment the counter value by 1
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $counter->incrby('counter', 1);
}

//converts int to string
$result = $counter->get('counter');
strval($result);

//outputs result as string to stdout
fwrite(STDOUT, "There has been a total of '$result' Requests so far");

// if value over 100 outputs information
if ($counter->get('counter') >= 100) {
    fwrite(STDOUT, ". Counter will not surpass 100, resetting!");
    $counter->expire('counter', 0);
}
