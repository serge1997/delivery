<?php
namespace App\Main\Promotion\Exception;


class PromotionException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
