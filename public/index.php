<?php

use Phalcon\Http\Request;

/**
 * @var ClassLoader $loader
 */
$loader = require_once __DIR__.'/../app/autoload.php';

require_once __DIR__.'/../app/TridentKernel.php';

$kernel = new TridentKernel(true);
$request = new Request();

$response = $kernel->handle($request);
$response->send();

echo '<br /><br />' . (xdebug_time_index() * 1000) . 'ms';
