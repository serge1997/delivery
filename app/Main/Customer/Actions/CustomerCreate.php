<?php
namespace App\Main\Customer\Actions;

use App\Main\Customer\Repository\CustomerRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class CustomerCreate
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ){}

    public function run(FormRequest $request)
    {

    }
}
