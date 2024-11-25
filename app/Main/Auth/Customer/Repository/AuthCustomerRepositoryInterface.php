<?php
namespace App\Main\Auth\Customer\Repository;

use App\Models\Customer;

interface AuthCustomerRepositoryInterface
{

    public function login($request, ?Customer $customer);
    public function logout($request);
}
