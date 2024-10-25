<?php
namespace App\Main\Restaurant\Actions;

use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;

class RestaurantUpdate
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository
    ){}

    public function updateImages($request)
    {
        $this->restaurantRepository->updateImages($request);
    }
}
