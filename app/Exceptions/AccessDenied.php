<?php

namespace App\Exceptions;

use Exception;
class AccessDenied extends Exception
{

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return [];
    }

}
