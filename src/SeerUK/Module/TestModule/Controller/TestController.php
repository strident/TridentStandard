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
        $reference = $resolver->resolve('::index.html.twig');

        var_dump($reference->getPath());

        return new Response();
    }
}
