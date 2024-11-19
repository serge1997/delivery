<?php
namespace App\Main\Customer\Actions;

use App\Main\Customer\Repository\CustomerRepositoryInterface;

class CustomerDelete
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    )
    {}

    public function run()
    {

    }
}
