<?php
namespace App\Main\FoodType\Exception;

class FoodTypeException extends \Exception
{
    public function __construct(string $message = null, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}