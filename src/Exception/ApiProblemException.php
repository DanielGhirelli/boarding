<?php

namespace App\Exception;

use App\Response\ApiProblem;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiProblemException extends HttpException
{
    public function __construct(private ApiProblem $apiProblem, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $statusCode = $apiProblem->getStatusCode();
        $message = $apiProblem->getTitle();

        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    public function getApiProblem()
    {
        return $this->apiProblem;
    }
}
