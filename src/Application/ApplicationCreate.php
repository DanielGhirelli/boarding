<?php

namespace App\Application;

use App\Entity\OmnifundApplications;
use App\Exception\ApplicationException;
use App\Form\ApplicationRegisterForm;
use App\Security\ApplicationFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Mailgun\Mailgun;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Twig\Environment;

class ApplicationCreate
{
    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory, private GuardAuthenticatorHandler $guardHandler, private ApplicationFormAuthenticator $formAuthenticator, private Environment $twigEnvironment)
    {
    }

    public function create(Request $request)
    {
        $application = New OmnifundApplications();

        $form = $this->formFactory->create(ApplicationRegisterForm::class, $application);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ApplicationException('Form is invalid!');
        }

        if(!($request->get("application_register_form")["confirm"] ?? false) && $this->validateRecord($application)) {
            throw new ApplicationException('
                This email has been registered already! <br/><br/> Are you sure you want to use the same email?
                <button type="submit" class="btn-link" style="font-weight: bold">Confirm</button>
            ', 001);
        }

        $application->setApplicationHash($this->generateHash());
        $this->entityManager->persist($application);
        $this->entityManager->flush();

        if('omnifund_pipeline_test' === $application->getIsoId())
        {
            return true;
        }

        $this->sendEmail($application);

        return $this->guardHandler->authenticateUserAndHandleSuccess(
            $application,
            $request,
            $this->formAuthenticator,
            'main'
        );
    }

    private function validateRecord(OmnifundApplications $application): ?bool
    {
        if($this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(
            ['businessEmail'=>$application->getBusinessEmail()]))
        {
            return true;
        }
        return false;
    }

    private function generateHash():? string
    {
        do {
            $applicationHash = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
            $em = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $applicationHash]);
        } while($em);

        return $applicationHash;
    }

    private function sendEmail(OmnifundApplications $application)
    {
        $body = $this->twigEnvironment->render('email/email_welcome.html.twig', [
            'applicationHash' => $application->getApplicationHash()
        ]);

        $mg = Mailgun::create(getenv('MAILGUN_API_KEY'));
        $mg->messages()->send(getenv('OMNIFUND_DOMAIN'), [
            'from' => getenv('OMNIFUND_NOREPLY'),
            'to' => $application->getBusinessEmail(),
            'subject' => 'Welcome to OmniFund',
            'html' => $body
        ]);
    }
}