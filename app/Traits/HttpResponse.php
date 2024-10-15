<?php
namespace App\Traits;

trait HttpResponse
{
    public function successResponse(string $message = "",  $data = null)
    {
        return [
            "status" => "success",
            "message"=> $message,
            "data"=> $data
        ];
    }

    public function errorResponse(string $message = "",  $data = null)
    {
        return [
            "status" => "error",
            "message"=> $message,
            "data"=> $data
        ];
    }
}
