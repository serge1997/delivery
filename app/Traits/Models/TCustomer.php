<?php
namespace App\Traits\Models;

use App\Models\Customer;

trait TCustomer
{

    public function emailExists(?string $email) : bool
    {
        return $email ? Customer::where('email', $email)->exists() : false;
    }
    public function phoneExists(string $phone) : bool
    {
        return Customer::where('phone', $phone)->exists();
    }
    public function nameExists(string $name) : bool
    {
        return Customer::where('name', $name)->exists();
    }
}
