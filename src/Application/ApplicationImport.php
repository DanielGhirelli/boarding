<?php

namespace App\Application;

use App\Entity\OmnifundApplications;
use App\Exception\ApplicationException;
use App\Exception\WebServiceException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApplicationImport
{
    public function __construct(private EntityManagerInterface $entityManager, private DenormalizerInterface $denormalizer, private ValidatorInterface $validator)
    {
    }

    public function import(array $data)
    {
        try {
            /** @var OmnifundApplications $application */
            $application = $this->denormalizer->denormalize($data, OmnifundApplications::class, null, [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]);
        }
        catch (\Exception $e) {
            throw new WebServiceException($e->getMessage(), 400);
        }

        if(null === $application)
        {
            throw new WebServiceException('Application received an error during creation!', 400);
        }

        $errors = $this->validateRequest($application, [
            'groups' => [
                'grp_business_info',
                'grp_business_bank'
            ]
        ]);
        if(null !== $errors)
        {
            $exception = new WebServiceException();
            $exception->setErrors($errors);

            throw $exception;
        }

        $application->setStep('register_complete');
        $application->setApplicationHash($this->generateHash());
        $this->entityManager->persist($application);
        $this->entityManager->flush();

        return $application;
    }

    private function validateRequest($request, $context)
    {
        /** @var ConstraintViolation[] $validationErrors */
        $validationErrors = $this->validator->validate($request, null, $context['groups']);

        if (count($validationErrors) > 0) {
            $errors = [];

            foreach($validationErrors as $validationError) {
                $errors[$validationError->getPropertyPath()] = $validationError->getMessage();
            }

            return $errors;
        }

        return null;
    }

    private function generateHash():? string
    {
        do {
            $applicationHash = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
            $em = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $applicationHash]);
        } while($em);

        return $applicationHash;
    }
}
