<?php
namespace App\Main\Customer\Actions;

use App\Main\Customer\Repository\CustomerRepositoryInterface;

class CustomerUpdate
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ){}
}
