<?php
namespace App\Main\Customer\Actions;

use App\Http\Resources\CustomerResource;
use App\Main\Customer\Exception\CustomerException;
use App\Main\Customer\Repository\CustomerRepositoryInterface;
use App\Traits\Models\TCustomer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerCreate
{
    use TCustomer;

    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ){}

    public function run(FormRequest $request)
    {
        if ($this->emailExists($request->email())){
            throw new CustomerException("email existe dejá");
        }

        if ($this->phoneExists($request->phone())){
            throw new CustomerException("le numero de telephone exists deja");
        }
        return new CustomerResource(
            $this->customerRepository->create($request)
        );


    }
}
