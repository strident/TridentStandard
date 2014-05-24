<?php

/**
 * Use APC loader if the module is available, remember to change 'Strident' to
 * something unique if you have more than one copy of Strident installed on
 * your server, or if you're using shared hosting.
 */
// use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

/**
 * @var ClassLoader $loader
 */
$loader = require_once __DIR__.'/../app/autoload.php';
// $loader = new ApcClassLoader('Trident', $loader);

// Debug::enable();

require_once __DIR__.'/../app/TridentKernel.php';
$kernel = new TridentKernel(true);

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
