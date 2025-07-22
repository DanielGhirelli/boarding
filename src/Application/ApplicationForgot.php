<?php


namespace App\Application;

use App\Entity\OmnifundApplications;
use App\Form\ApplicationForgotForm;
use Doctrine\ORM\EntityManagerInterface;
use Mailgun\Mailgun;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class ApplicationForgot
{
    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory, private Environment $twigEnvironment)
    {
    }

    public function forgot(Request $request)
    {
        $applicationForm = New OmnifundApplications();

        $form = $this->formFactory->create(ApplicationForgotForm::class, $applicationForm);
        $form->handleRequest($request);

        $list = $this->entityManager->getRepository(OmnifundApplications::class)->findBy([
            'businessEmail' => $applicationForm->getBusinessEmail()
        ]);

        foreach ($list as $application) {
            $body = $this->twigEnvironment->render('email/email_forgot.html.twig', [
                'businessLegalName' => $application->getBusinessContactFirst() . ' ' . $application->getBusinessContactLast(),
                'applicationHash' => $application->getApplicationHash()
            ]);

            $mg = Mailgun::create(getenv('MAILGUN_API_KEY'));
            $mg->messages()->send(getenv('OMNIFUND_DOMAIN'), [
                'from' => getenv('OMNIFUND_NOREPLY'),
                'to' => $application->getBusinessEmail(),
                'subject' => 'Recover My Application ID',
                'html' => $body
            ]);
        }

        return true;
    }
}
