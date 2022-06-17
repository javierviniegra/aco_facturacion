<?php

namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsRfc extends Constraint
{
    public $message = 'La Cadena "{{ string }}" no es un RFC válido.';
}