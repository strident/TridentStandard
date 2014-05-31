<?php

return function ($container) {
    // Parameters
    $container['test.entity.user.class'] = 'SeerUK\\Module\\TestModule\\Data\\Entity\\User';


    // Services
    $container->set('test.repository.user', function($c) {
        return $c->get('doctrine.orm.entity_manager')
            ->getRepository($c['test.entity.user.class']);
    });
};
