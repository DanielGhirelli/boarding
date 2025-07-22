<?php


namespace App\Register;

use App\Entity\OmnifundApplications;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegisterUpdate
{
    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory, private TokenStorageInterface $tokenStorage, private RegisterStep $registerStep)
    {
    }

    public function update(Request $request, $formPath)
    {
        /** @var OmnifundApplications $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $application = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $user->getApplicationHash()]);

        $currentStep = $application->getStep();

        $form = $this->formFactory->create($formPath, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $application->setStep($this->registerStep->getMap($currentStep, $application->getStep()));

            $this->entityManager->persist($application);
            $this->entityManager->flush();

            return 'success';
        }

        return $form;
    }
}