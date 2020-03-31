<?php
namespace Lacasera\MazzumaApi\Exceptions;

use Exception;
use Throwable;

class ServiceNotSetException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}