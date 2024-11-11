<?php
namespace App\Main\MenuitemSideDish;

use Exception;

class MenuitemSideDishException extends Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
