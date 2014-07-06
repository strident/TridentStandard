<?php

return function($container) {
    // Extensions
    $container->extend('security.aegis.authenticator.delegating', function($authenticator, $c) {
        $authenticator->addAuthenticator($c->get('test.security.aegis.authenticator.test_user'));

        return $authenticator;
    });

    $container->extend('security.aegis.authorization_manager', function($authorizationManager, $c) {
        $authorizationManager->addVoter($c->get('test.security.aegis.authorization.voter.user_repo'));

        return $authorizationManager;
    });
};
