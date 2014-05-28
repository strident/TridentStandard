<?php

namespace SeerUK\Module\TestModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

class TestController extends Controller
{
    public function testAction()
    {
        $resolver  = $this->get('templating_name_resolver');
        $reference = $resolver->resolve('SeerUKTestModule:Test:index.html.twig');

        var_dump($this->get('configuration')->count());
        var_dump($this->get('configuration')->get('test', 'Testing'));
        var_dump($this->get('configuration')->get('database.default.host'));
        var_dump($this->get('configuration')->get('database.secondary.host'));
        var_dump($this->get('configuration')->get('twig.cache_dir'));

        return new Response($reference->getPath());
    }
}
