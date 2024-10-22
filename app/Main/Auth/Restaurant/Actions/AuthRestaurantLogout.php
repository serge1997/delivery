<?php
namespace App\Main\Auth\Restaurant\Actions;

use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepositoryInterface;

class AuthRestaurantLogout
{
    public function __construct(
        private AuthRestaurantRepositoryInterface $authRestaurantRepository
    ){}

    public function run($request)
    {
        $this->authRestaurantRepository->logout($request);
    }
}
