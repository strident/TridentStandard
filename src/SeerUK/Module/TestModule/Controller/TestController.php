<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

use SeerUK\Module\TestModule\Data\Entity\User;
use Trident\Component\Caching\CachingProxy;

/**
 * Test Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class TestController extends Controller
{
    public function testAction()
    {
        $start = microtime(true);

        $caching = $this->get('caching');
        $repo    = $this->get('test.repository.user');
        $proxy   = new CachingProxy();
        $proxy->setDriver($caching);

        var_dump($proxy);

        $users = $proxy->get('users', function() use($repo) {
            return $repo->findAll();
        });

        var_dump($users);
        exit;

        // Create ProxyCache.php
        //
        // This class will accept a name, and a closer. The name will be the
        // cache key, the closure will contain the 'real' data source.
        //
        // From this proxy cache, a single method may be run to get the value.
        // The proxy cache will be set up with the cache factory.

        $real = function($container) {
            return $container->get('test.repository.user')->findAll();
        };

        $getUsers = function($container, $key, \Closure $real) {
            $caching = $container->get('caching');

            if ($caching->has($key)) {
                return $caching->get($key);
            }

            $data = $real($container);
            $caching->set($key, $data);

            return $data;
        };

        var_dump($getUsers);
        var_dump(count($getUsers($this->container, 'users', $real)));

        // $em   = $this->get('doctrine.orm.entity_manager');

        // $user = new User();
        // $user->setUsername('Test' . ($last->getId() + 1));
        // $user->setPassword('TestPassword');

        // $em->persist($user);
        // $em->flush();

        $end = microtime(true);

        // var_dump($users);
        // var_dump(count($users));
        var_dump(($end - $start) * 1000);

        return $this->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => 'Elliot'
        ]);
    }

    public function variableAction($name)
    {
        return $this->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => $name
        ]);
    }
}
