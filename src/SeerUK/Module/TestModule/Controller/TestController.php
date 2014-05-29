<?php

namespace SeerUK\Module\TestModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

class TestController extends Controller
{
    public function testAction()
    {
        return new Response($this->get('templating')->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => 'Elliot'
        ]));
    }
}
