<?php

return function($container) {
    // Extensions
    $container->extend('security.aegis.authenticator.delegating', function($authenticator, $c) {
        $authenticator->addAuthenticator($c->get('test.security.aegis.authenticator.test_user'));

        return $authenticator;
    });
};
