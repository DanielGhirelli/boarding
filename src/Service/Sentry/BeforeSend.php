<?php

namespace App\Service\Sentry;

use App\Exception\ApplicationException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class BeforeSend
{
    public function getBeforeSend(): callable
    {
        return function (\Sentry\Event $event, ?\Sentry\EventHint $hint): ?\Sentry\Event {
            // Ignore the following events
            if ($hint !== null && $hint->exception instanceof AccessDeniedException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof MethodNotAllowedHttpException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof NotFoundHttpException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof BadCredentialsException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof ForeignKeyConstraintViolationException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof AuthenticationCredentialsNotFoundException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof InvalidCsrfTokenException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof ApplicationException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof \UnexpectedValueException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof \LogicException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof BadRequestHttpException) {
                return null;
            } elseif ($hint !== null && $hint->exception instanceof CustomUserMessageAuthenticationException) {
                return null;
            }

            return $event;
        };
    }
}