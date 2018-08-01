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
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
