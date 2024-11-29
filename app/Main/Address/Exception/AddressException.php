<?php
namespace App\Main\Address\Exception;

class AddressException extends \Exception
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
