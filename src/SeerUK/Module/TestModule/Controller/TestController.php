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

        $em = $this->get('doctrine.orm.entity_manager');
        $user = $em->find('SeerUK\Module\TestModule\Data\Entity\User', 1);

        var_dump($user);

        $end = microtime(true);

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
