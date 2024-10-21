<?php
namespace App\Main\Auth\Restaurant\Repository;


interface AuthRestaurantRepositoryInterface
{
    public function login($request);
    public function logout();
}
