<?php


namespace App\Register;

use App\Entity\OmnifundApplications;
use Doctrine\ORM\EntityManagerInterface;
use Mailgun\Mailgun;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class RegisterComplete
{
    public function __construct(private EntityManagerInterface $entityManager, private TokenStorageInterface $tokenStorage, private Environment $twigEnvironment)
    {
    }

    public function complete(Request $request)
    {
        /** @var OmnifundApplications $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $application = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $user->getApplicationHash()]);

        $this->sendEmail($application);
    }

    private function sendEmail(OmnifundApplications $application)
    {
        $body = $this->twigEnvironment->render('email/email_complete.html.twig', [
            'application' => $application
        ]);

        $mg = Mailgun::create(getenv('MAILGUN_API_KEY'));
        $mg->messages()->send(getenv('OMNIFUND_DOMAIN'), [
            'from' => getenv('OMNIFUND_NOREPLY'),
            'to' => getenv('OMNIFUND_TO'),
            'subject' => 'OmniFund Application #' . $application->getApplicationHash(),
            'html' => $body
        ]);
    }
}