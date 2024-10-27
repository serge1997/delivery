<?php
namespace App\Main\RestaurantFoodType\Exception;


class RestaurantFoodTypeException extends \Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
