<?php
namespace App\Main\Menuitem\Exception;


class MenuitemException extends \Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
