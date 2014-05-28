<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * @var ClassLoader $loader
 */
$loader = require_once __DIR__.'/../app/autoload.php';

require_once __DIR__.'/../app/TridentKernel.php';

$kernel = new TridentKernel(true);
$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();
