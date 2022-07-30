<?php

namespace App\EventListener;


use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
//        $exception = $event->getThrowable();
//        $message = 'Error: ' . $exception->getCode() . ' ' . $exception->getMessage();
//
//        $responce = new Response();
//        $responce->setContent($message);
//        $event->setResponse($responce);
    }
}