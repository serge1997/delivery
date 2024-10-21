<?php
namespace App\Main\Auth\Restaurant\Actions;

use App\Http\Requests\AuthRestaurantRequest;
use App\Main\Auth\Restaurant\Repository\AuthRestaurantRepositoryInterface;

class AuthRestaurantLogin
{
    public function __construct(
        private AuthRestaurantRepositoryInterface $authRestaurantRepository
    ){}

    public function auth(AuthRestaurantRequest $request)
    {
        return $this->authRestaurantRepository->login($request);
    }
}
