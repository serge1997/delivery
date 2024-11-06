<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Http\Resources\RestaurantFoodTypeResource;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeList
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository
    ){}

    public function listAll()
    {

    }

    public function listByRestaurantId(int $id)
    {
        return RestaurantFoodTypeResource::collection(
            $this->restaurantFoodTypeRepository->findByRestaurantId($id)
        );
    }

    public function listAllByRestaurantHasMenuitems(int $restaurant_id)
    {
        return RestaurantFoodTypeResource::collection(
            $this->restaurantFoodTypeRepository->findAllByRestaurantHasMenuitems($restaurant_id)
        );
    }
}
