<?php

return function ($container) {
    // Parameters
    $container['test.entity.user.class']                 = 'SeerUK\\Module\\TestModule\\Data\\Entity\\User';
    $container['test.intercept_response_listener.class'] = 'SeerUK\\Module\\TestModule\\Event\\InterceptResponseListener';


    // Services
    $container->set('test.repository.user', function($c) {
        return $c->get('doctrine.orm.entity_manager')
            ->getRepository($c['test.entity.user.class']);
    });

    $container->set('test.intercept_response_listener', function($c) {
        return new $c['test.intercept_response_listener.class']();
    });

    // Extensions
    $container->extend('event_dispatcher', function($dispatcher, $c) {
        // $dispatcher->addListener('kernel.request', [
        //     $c->get('test.intercept_response_listener'),
        //     'onRequest'
        // ]);

        return $dispatcher;
    });
};
