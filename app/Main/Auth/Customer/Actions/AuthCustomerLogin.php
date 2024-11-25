<?php
namespace App\Main\Auth\Customer\Actions;

use App\Http\Requests\AuthCustomerRequest;
use App\Main\Auth\Customer\Repository\AuthCustomerRepositoryInterface;
use App\Main\Customer\Repository\CustomerRepositoryInterface;

final class AuthCustomerLogin
{
    public function __construct(
        private readonly AuthCustomerRepositoryInterface $authCustomerRepository,
        private readonly CustomerRepositoryInterface $customerRepository
    ){}

    public function auth(AuthCustomerRequest $request)
    {
        $customer = $this->customerRepository->findByPhone($request->phone);
        return $this->authCustomerRepository->login($request, $customer);
    }
}
