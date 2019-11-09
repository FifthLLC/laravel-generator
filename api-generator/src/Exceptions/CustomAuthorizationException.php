<?php

namespace Fifth\Generator\Exceptions;

use Exception;

class CustomAuthorizationException extends Exception
{
    protected $code;

    public function __construct($message, int $code = 403, Exception $previous = null)
    {
        parent::__construct(json_encode($message), $code, $previous);

        $this->code = $code;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
