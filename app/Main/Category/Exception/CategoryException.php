<?php
namespace App\Main\Category\Exception;

class CategoryException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
