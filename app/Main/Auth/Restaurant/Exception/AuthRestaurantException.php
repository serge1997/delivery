<?php
namespace App\Main\Auth\Restaurant\Exception;


class AuthRestaurantException extends \Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
