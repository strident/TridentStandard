<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * @var ClassLoader $loader
 */
$loader = require_once __DIR__.'/../app/autoload.php';

require_once __DIR__.'/../app/TridentKernel.php';

// Debug::enable();

$kernel = new TridentKernel('dev', TridentKernel::DEBUG_DISABLED);
// $kernel = new TridentKernel('dev', TridentKernel::DEBUG_ENABLED);
$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
