<?php

namespace App\Security;

use App\Entity\OmnifundApplications;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class ApplicationFormAuthenticator extends AbstractFormLoginAuthenticator
{
    public function __construct(private EntityManagerInterface $entityManager, private RouterInterface $router, private FlashBagInterface $flashBag, private CsrfTokenManagerInterface $csrfToken)
    {
    }

    public function supports(Request $request)
    {
        return 'index_application' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $businessEmail = $request->request->get('application_login_form') ? $request->request->get('application_login_form')['businessEmail'] : "";
        $applicationHash = $request->request->get('application_login_form') ? $request->request->get('application_login_form')['applicationHash'] : "";

        $credentials = [
            'businessEmail' => $businessEmail,
            'applicationHash' => $applicationHash,
            'csrf_token' => $request->request->get('_csrf_token') ?? ""
        ];

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('omnifund_boarding_auth', $credentials['csrf_token']);
        if (!$this->csrfToken->isTokenValid($token)) {
            $this->flashBag->add('errorLogin', 'Invalid token credentials.');
            $this->flashBag->add('errorLoginEmail', $credentials['businessEmail']);
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy([
            'businessEmail' => $credentials['businessEmail'],
            'applicationHash' => $credentials['applicationHash']
        ]);

        if (!$user) {
            $this->flashBag->add('errorLogin', 'Invalid credentials.');
            $this->flashBag->add('errorLoginEmail', $credentials['businessEmail']);
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if($credentials['applicationHash'] != $user->getPassword())
        {
            $this->flashBag->add('errorLogin', 'Invalid credentials.');
            $this->flashBag->add('errorLoginEmail', $credentials['businessEmail']);
            return false;
        }

        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('index_register'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('index_application');
    }
}
