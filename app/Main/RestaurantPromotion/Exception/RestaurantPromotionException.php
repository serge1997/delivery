<?php
namespace App\Main\RestaurantPromotion\Exception;

class RestaurantPromotionException extends \Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
