<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';

use Phimple\Container;
use Phimple\LockBox;

$container = new Container();
$container->set('test', function($c) {
    $lockbox = new LockBox();
    $lockbox->set('name', 'test'); // Just to identify this lockbox in DIC
    return $lockbox;
});

$container->set('factory', $container->factory(function($c) {
    // This is where the real test begins...
    $lockbox = new LockBox();
    $lockbox->set('name', 'factory'); // Just to identify this lockbox in DIC
    return $lockbox;
}));

// Make test default to having an ID of 1
$container->extend('test', function($test, $c) {
    $test->set('id', 1);

    return $test;
});

// Make factory default to having an ID of 1
$container->extend('factory', function($factory, $c) {
    $factory->set('id', 1);

    return $factory;
});

var_dump("Container State - Pre-fetch");
var_dump($container);
var_dump("Service returned from service");

// This should make the changes on both objects
$service1 = $container->get('test');
$service2 = $container->get('test');

// This should make both service1 and service2 have an ID of 2
$service2->set('id', 2);

var_dump($service1);
var_dump($service2);

var_dump("Factory returned from service");

// This should let me make 2 completely different objects
$factory1 = $container->get('factory');
$factory2 = $container->get('factory');

// This should only make factory2 have an ID of 2
$factory2->set('id', 2);

var_dump($factory1);
var_dump($factory2);

var_dump("Container State - Post-fetch");
var_dump($container);
exit;
