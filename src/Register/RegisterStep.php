<?php


namespace App\Register;

use App\Entity\OmnifundApplications;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegisterStep
{
    private $workflowMap = [
        'register_welcome',
        'register_business_info',
        'register_business_struc',
        'register_ownership_info',
        'register_business_bank',
        'register_card',
        'register_ach',
        'register_document',
        'register_complete'
    ];

    public function __construct(private EntityManagerInterface $entityManager, private TokenStorageInterface $tokenStorage)
    {
    }

    public function route(): ?string
    {
        /** @var OmnifundApplications $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $application = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $user->getApplicationHash()]);

        return $application->getStep();
    }

    public function getMap($current, $next): ?string
    {
        $currentPos = array_search($current, $this->workflowMap);
        $nextPos = array_search($next, $this->workflowMap);

        if($currentPos > $nextPos)
        {
            return $current;
        }

        return $next;
    }
}