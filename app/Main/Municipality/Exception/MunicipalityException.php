<?php
namespace App\Main\Municipality\Exception;


class MunicipalityException extends \Exception
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
