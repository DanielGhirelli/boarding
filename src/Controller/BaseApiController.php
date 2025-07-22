<?php

namespace App\Controller;

use App\Response\ApiProblem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseApiController extends AbstractController
{
    protected function createApiResponse($data, $statusCode=200)
    {
        $json = json_encode($data);

        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }

    protected function throwApiProblemException($errorType, array $errors=[], $status=400)
    {
        $apiProblem = new ApiProblem($status, $errorType);

        if (count($errors) > 0) {
            $apiProblem->set('errors', $errors);
        }

        return $this->createApiResponse(
            $apiProblem->toArray()
        );
    }
}
