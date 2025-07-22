<?php

namespace App\Controller\Api;

use App\Application\ApplicationImport;
use App\Controller\BaseApiController;
use App\Exception\WebServiceException;
use App\Response\ApiProblem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationImportApi extends BaseApiController
{
    public function __construct(private ApplicationImport $applicationImport)
    {
    }

    /**
     * @Route("/api/import", name="application_import", methods={"POST"})
     */
    public function import(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (null === $data) {
                return $this->throwApiProblemException(
                    ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT
                );
            }

            $response = $this->applicationImport->import($data);
        }
        catch(WebServiceException $exception) {
            return $this->throwApiProblemException(ApiProblem::TYPE_VALIDATION_ERROR, $exception->getErrors());
        }

        return $this->createApiResponse($response->getAsArray());
    }
}
