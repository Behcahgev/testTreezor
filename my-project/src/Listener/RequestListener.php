<?php

namespace App\Listener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Entity\Log;

class RequestListener
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMainRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $response = $event->getResponse();
        
        // Set multiple headers simultaneously
        $response->headers->add([
            'X-ROUTE-APP' => $event->getRequest()->attributes->get('_route')
        ]);

        $route = ($event->getRequest()->attributes->get('_route') === null ? $event->getResponse()->attributes->get('targetUrl')
        : $event->getRequest()->attributes->get('_route'));

        $log = new Log();
        $log->setIp($event->getRequest()->server->get('REMOTE_ADDR'));
        $log->setRoute($event->getRequest()->attributes->get('_route'));
        $log->setDate(new \DateTime());

        $this->em->persist($log);
        $this->em->flush();
    }
}