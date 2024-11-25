<?php
namespace App\Main\Auth\Customer\Exception;

class AuthCustomerException extends \Exception
{
    public function __construct(string $message = null, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
