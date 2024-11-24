<?php
namespace App\Traits\Models;

use App\Models\Customer;

trait TCustomer
{

    public function emailExists(?string $email) : bool
    {
        return Customer::where('email', $email)->exists();
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
