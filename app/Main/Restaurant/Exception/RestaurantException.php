<?php
namespace App\Main\Restaurant\Exception;


class RestaurantException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
