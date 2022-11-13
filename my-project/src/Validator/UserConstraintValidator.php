<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Exception;


class CustomerConstraintValidator extends ConstraintValidator
{

    public function validate($protocol, Constraint $constraint): void
    {
dd('test');
    }

}
