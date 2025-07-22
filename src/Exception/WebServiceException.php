<?php

namespace App\Exception;

class WebServiceException extends \Exception
{
    private $errors;

    public function getErrors(): array
    {
        if ($this->errors !== null) {
            return $this->errors;
        }

        return [$this->message];
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
}
