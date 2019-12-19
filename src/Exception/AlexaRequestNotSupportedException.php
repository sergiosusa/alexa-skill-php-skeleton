<?php
declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class AlexaRequestNotSupportedException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Request %s is not supported.', $message), $code, $previous);
    }
}
