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
use Trident\Component\HttpKernel\Exception\ForbiddenHttpException;
use Trident\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $proxy = $this->get('caching.proxy');

        // Lame example exception
        // if ($proxy->getDriver()->has('homepage')) {
            throw new ForbiddenHttpException('You do not have access to this page.');
        // }

        $proxied = $proxy->proxy('homepage', function() {
            $repo = $this->get('test.repository.user');
            $repo->setCachingProxy($this->get('caching.proxy'));

            $users = $repo->findAll();
            $users = $repo->findAll();

            return $this->render('SeerUKTestModule:Test:index.html.twig', [
                'name' => count($users)
            ]);
        });

        return $proxied;
    }

    public function variableAction($name)
    {
        if (true) {
            throw new NotFoundHttpException("No $name was found.");
        }

        return $this->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => $name
        ]);
    }
}
