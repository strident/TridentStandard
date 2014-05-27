<?php

namespace SeerUK\Module\TestModule\Controller;

use Phalcon\Http\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

use Trident\Component\Templating\TemplateNameResolver;

class TestController extends Controller
{
    public function testAction()
    {
        $resolver  = new TemplateNameResolver($this->container->get('kernel'));
        $name = 'SeerUKTestModule:Test:index.html.twig';
        $reference = $resolver->resolve($name);

        var_dump($name);
        var_dump($reference->getPath());

        return new Response();
    }
}
