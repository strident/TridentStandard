<?php

use Symfony\Component\Routing\Route;

return function($routes) {
    $routes->add('trident_test', new Route('/', [
        '_controller' => 'SeerUK\\Module\\TestModule\\Controller\\TestController::testAction'
    ]));

    $routes->add('hello_name', new Route('/hello/{name}', [
        '_controller' => 'SeerUK\\Module\\TestModule\\Controller\\TestController::variableAction'
    ]));
};
