<?php

namespace App\Exceptions;

/**
 * Class URLIsNotValidException
 * @package App\Exceptions
 */
class URLIsNotValidException extends \Exception
{
    /**
     * URLIsNotValidException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
