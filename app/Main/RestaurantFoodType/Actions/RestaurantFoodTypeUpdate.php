<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Http\Resources\RestaurantFoodTypeResource;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeUpdate
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository
    ){}

    public function toggleIsActive(int $id)
    {
        $restaurantFoodType = $this->restaurantFoodTypeRepository->find($id);
        return new RestaurantFoodTypeResource(
            $this->restaurantFoodTypeRepository->handleToggleIsActive($restaurantFoodType)
        );
    }
}
