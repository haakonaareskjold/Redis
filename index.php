<?php

/**
 * Changed the function to output to stderr instead of stdout, despite not these being errors
 * This is so Docker can display the stdout message along with the requests
 */

// print out log row with current count of request to stderr
if(!defined('STDERR')) define('STDERR', fopen('php://stderr', 'w'));

// composer autoload
require_once __DIR__. "/vendor/autoload.php";

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

echo $result;

//outputs result as string to stderr
fwrite(STDERR, "There has been a total of '$result' Requests so far");


// if value over 100 outputs information
if ($counter->get('counter') >= 100) {
    fwrite(STDERR, ". Counter will not surpass 100, resetting!");
    $counter->expire('counter', 0);
}
