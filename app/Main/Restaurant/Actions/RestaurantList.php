<?php
namespace App\Main\Restaurant\Actions;

use App\Http\Resources\RestaurantResource;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;

class RestaurantList
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository
    ){}

    public function listAllActives()
    {
        return RestaurantResource::collection(
            $this->restaurantRepository->findAllActives()
        );
    }
}
