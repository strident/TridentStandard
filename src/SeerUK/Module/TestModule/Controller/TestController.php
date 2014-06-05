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

        $repo = $this->get('test.repository.user');
        $repo->setCachingProxy($this->get('caching.proxy'));

        $users = $repo->findAll();

        // $em   = $this->get('doctrine.orm.entity_manager');

        // $user = new User();
        // $user->setUsername('Test' . ($last->getId() + 1));
        // $user->setPassword('TestPassword');

        // $em->persist($user);
        // $em->flush();

        $end = microtime(true);

        // var_dump($users);
        var_dump(count($users));
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
