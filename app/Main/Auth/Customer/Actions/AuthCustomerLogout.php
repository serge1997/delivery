<?php
namespace App\Main\Auth\Customer\Actions;

use App\Main\Auth\Customer\Repository\AuthCustomerRepositoryInterface;

final class AuthCustomerLogout
{

    public function __construct(
        private AuthCustomerRepositoryInterface $authCustomerRepository
    ){}

    public function run($request)
    {
        $this->authCustomerRepository->logout($request);
    }
}
