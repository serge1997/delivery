<?php
namespace App\Main\Customer\Exception;

use Exception;

class CustomerException extends Exception
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
