<?php

namespace SeerUK\Module\TestModule\Event;

use Symfony\Component\HttpFoundation\Response;
use Trident\Component\HttpKernel\Event\InterceptResponseEvent;

class InterceptResponseListener
{
    public function onRequest(InterceptResponseEvent $event)
    {
        $event->setResponse(new Response('Test'));

        return $event;
    }
}
