<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;


class CustomerConstraint extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }


    public function validatedBy(): string
    {
        return get_class($this).'Validator';
    }
}