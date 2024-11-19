<?php
namespace App\Main\Customer\Actions;

use App\Main\Customer\Repository\CustomerRepositoryInterface;

class CustomerList
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ){}

}
