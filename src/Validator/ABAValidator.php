<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ABAValidator Extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        // must begin with 0, 1, 2, or 3
        $firstNumber = substr($value,0,1);

        if (0 != $firstNumber && 1 != $firstNumber && 2 != $firstNumber && 3 != $firstNumber) {
            $this->context->addViolation($constraint->message);
            return;
        }

        // First, remove any non-numeric characters.
        $t = "";
        for ($i = 0; $i < strlen($value); $i++) {
            $c = (int) substr($value, $i, 1);
            if ($c >= 0 && $c <= 9)
                $t = $t . $c;
        }

        // Check the length, it should be nine digits.
        if (9 != strlen($t)) {
            $this->context->addViolation($constraint->message);
            return;
        }

        // Now run through each digit and calculate the total.
        $n = 0;
        for ($i = 0; $i < strlen($t); $i += 3) {
            $n += (int) substr($value, $i, 1) * 3
                + (int) substr($value, $i + 1, 1) * 7
                + (int) substr($value, $i + 2, 1);
        }

        // If the resulting sum is an even multiple of ten (but not zero),
        // the aba routing number is good.
        if (0 == $n || 0 != ($n % 10)) {
            $this->context->addViolation($constraint->message);
            return;
        }
    }
}