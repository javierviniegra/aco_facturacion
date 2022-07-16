<?php

namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsIdentificador extends Constraint
{
    public $message = 'La Cadena "{{ string }}" no es un Identificador de Envío válido.';
}