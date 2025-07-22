<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ApiKeyAuthenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        // Check if the request has the "x-api-key" header
        return $request->headers->has('x-api-key');
    }

    public function getCredentials(Request $request)
    {
        // Retrieve the API key from the request header
        return [
            'apiKey' => $request->headers->get('x-api-key'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiKey = $credentials['apiKey'];

        if (null === $apiKey) {
            return null;
        }

        if (!$userProvider instanceof ApiKeyUserProvider) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of ApiKeyUserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        // Validate and get the username associated with the API key
        $username = $userProvider->getUsernameForApiKey($apiKey);

        if (!$username) {
            throw new CustomUserMessageAuthenticationException(
                'Invalid API Key.'
            );
        }

        // Load and return the user
        return $userProvider->loadUserByUsername($username);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $apiKey = $credentials['apiKey'];

        // Check if the API key is valid by comparing it to a stored value (e.g., an environment variable)
        return $apiKey === getenv('API_KEY');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response($exception->getMessageKey(), Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // Return null to allow the request to proceed
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // This method is called when authentication is required but not provided
        return new Response('Authentication Required', Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
