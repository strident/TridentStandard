<?php

return function ($container) {
    // Parameters
    $container['test.entity.user.class']                            = 'SeerUK\\Module\\TestModule\\Data\\Entity\\User';
    $container['test.intercept_response_listener.class']            = 'SeerUK\\Module\\TestModule\\Event\\InterceptResponseListener';
    $container['test.security.aegis.authenticator.test_user.class'] = 'SeerUK\\Module\\TestModule\\Security\\Authentication\\Authenticator\\TestUserAuthenticator';


    // Services
    $container->set('test.repository.user', function($c) {
        return $c->get('doctrine.orm.entity_manager')
            ->getRepository($c['test.entity.user.class']);
    });

    $container->set('test.intercept_response_listener', function($c) {
        return new $c['test.intercept_response_listener.class']();
    });

    $container->set('test.security.aegis.authenticator.test_user', function($c) {
        return new $c['test.security.aegis.authenticator.test_user.class']($c->get('doctrine.orm.entity_manager'));
    });
};
