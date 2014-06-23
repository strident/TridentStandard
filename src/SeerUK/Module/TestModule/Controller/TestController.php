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

use Aegis\Aegis;
use Aegis\Result;
use Aegis\Authentication\Provider\DelegatingAuthenticationProvider;
use Aegis\Authentication\Provider\FakeUserProvider;
use Aegis\Storage\NullStorage;

/**
 * Test Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class TestController extends Controller
{
    public function testAction()
    {
        $proxy    = $this->get('caching.proxy');
        $security = $this->get('security');

        $provider = new FakeUserProvider($this->get('request'));
        $token = $provider->present();

        $result = $security->authenticate($token);

        // var_dump($security->getToken()->getUser()->getUsername());

        // switch ($result->getCode()) {
        //     case Result::SUCCESS:
        //         echo 'Successful authentication.';
        //         break;
        //     case Result::NO_TOKEN:
        //         echo 'No token was found.';
        //         break;
        //     case Result::UNKNOWN:
        //     default:
        //         echo 'Unknown authentication issue.';
        //         break;
        // }

        // var_dump($result);
        // var_dump($result->getToken());

        // var_dump($aegis->getToken());
        // var_dump($aegis->getToken()->getCredentials());
        // var_dump($aegis->getToken()->getUser()->getUsername());
        // var_dump($aegis);
        // exit;

        // Lame example exception
        // if ($proxy->getDriver()->has('homepage')) {
            // throw new ForbiddenHttpException('You do not have access to this page.');
        // }

        $proxied = $proxy->proxy('homepage', function() {
            $repo = $this->get('test.repository.user');
            $repo->setCachingProxy($this->get('caching.proxy'));

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
