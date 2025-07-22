<?php


namespace App\Register;

use App\Entity\OmnifundApplications;
use App\Entity\OmnifundApplicationsDocs;
use App\Form\RegisterDocumentForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Aws\S3\S3Client;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegisterDocumentAWS
{
    public function __construct(private EntityManagerInterface $entityManager, private FormFactoryInterface $formFactory, private TokenStorageInterface $tokenStorage)
    {
    }

    public function upload(Request $request)
    {
        /** @var OmnifundApplications $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $application = $this->entityManager->getRepository(OmnifundApplications::class)->findOneBy(['applicationHash' => $user->getApplicationHash()]);

        $form = $this->formFactory->create(RegisterDocumentForm::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $s3Client = $this->loginAWS();

            $file = $this->adjustExtraUpload($request->files->get('register_document_form'), $form);
            $this->uploadAWS($file, $application, $s3Client);

            return 'success';
        }

        return $form;
    }

    public function loginAWS(): ?S3Client
    {
        return new S3Client([
                'version' => getenv('S3_VERSION'),
                'region' => getenv('S3_REGION')
            ]);
    }

    public function getExpirationUrl(S3Client $s3Client, $filePath, $expiration): ?string
    {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => getenv('S3_BUCKET'),
            'Key' => $filePath
        ]);

        $request = $s3Client->createPresignedRequest($cmd, $expiration);
        return (string) $request->getUri();
    }

    private function uploadAWS($file, OmnifundApplications $application, S3Client $s3Client)
    {
        foreach ($file as $files=>$value){
            if($value) {
                $applicationDoc = New OmnifundApplicationsDocs();
                $applicationDoc->setApplication($application);

                $applicationDoc->setCategory($files);
                $applicationDoc->setName($value->getClientOriginalName());
                $applicationDoc->setType($value->getMimeType());
                $applicationDoc->setSize($value->getSize());

                $s3Client->putObject([
                    'Bucket' => getenv('S3_BUCKET'),
                    'Key' => "applications/{$application->getApplicationHash()}/{$applicationDoc->getName()}",
                    'Body' => file_get_contents($value),
                ]);

                $this->entityManager->persist($applicationDoc);
                $this->entityManager->flush();
            }
        }
    }

    private function adjustExtraUpload($file, Form $form)
    {
        $file[$form->get('extra1Type')->getData()] = $file['extra1'];
        unset($file['extra1']);

        return $file;
    }
}