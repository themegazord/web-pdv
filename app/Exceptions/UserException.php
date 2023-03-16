<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserException extends Exception
{
    public static function EmailJaExiste(): self {
        return new self('O email já está em uso, por favor, use outro', Response::HTTP_UNAUTHORIZED);
    }

    public static function EmailESenhaInvalidos(): self {
        return new self('O email ou a senha estão inválidos', Response::HTTP_UNAUTHORIZED);
    }
}
