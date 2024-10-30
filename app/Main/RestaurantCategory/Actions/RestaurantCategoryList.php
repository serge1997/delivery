<?php
namespace App\Main\RestaurantCategory\Actions;

use App\Http\Resources\RestaurantCategoryResource;
use App\Http\Resources\RestaurantResource;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;

class RestaurantCategoryList
{
    public function __construct(
        private RestaurantCategoryRepositoryInterface $restaurantCategoryRepository,
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}

    public function listByRestaurantId(int $id)
    {
        $restaurant = $this->restaurantRepository->find($id);
        return RestaurantCategoryResource::collection(
            $this->restaurantCategoryRepository->findByRestaurantId($restaurant)
        );
    }
}
