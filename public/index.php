<?php

$start = microtime(true);

use Symfony\Component\HttpFoundation\Request;

/**
 * @var ClassLoader $loader
 */
$loader = require_once __DIR__.'/../app/autoload.php';

require_once __DIR__.'/../app/TridentKernel.php';

$kernel = new TridentKernel('dev', TridentKernel::DEBUG_ENABLED);
$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();

$end = microtime(true);

echo '<br /><br />Rendered in ' . (($end - $start) * 1000) . 'ms';
