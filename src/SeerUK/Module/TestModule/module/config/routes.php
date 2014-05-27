<?php

use Symfony\Component\Routing\Route;

return function($routes) {
    $routes->add('trident_test', new Route('/', array(
        '_controller' => 'SeerUK\\Module\\TestModule\\Controller\\TestController::testAction'
    )));
};
