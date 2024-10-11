<?php

namespace App\Exceptions\Auth;

use App\Traits\JsonRenderTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class InvalidCredentialException extends Exception
{
    use JsonRenderTrait;

    public function __construct()
    {
        parent::__construct('invalid_credential', 401);
    }
}
