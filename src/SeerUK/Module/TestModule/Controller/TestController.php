<?php

namespace SeerUK\Module\TestModule\Controller;

use Phalcon\Http\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

class TestController extends Controller
{
    public function testAction()
    {
        return new Response('Hello world!', 200);
    }
}
