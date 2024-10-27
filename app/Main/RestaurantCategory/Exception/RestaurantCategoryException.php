<?php
namespace App\Main\RestaurantCategory\Exception;


class RestaurantCategoryException extends \Exception
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}