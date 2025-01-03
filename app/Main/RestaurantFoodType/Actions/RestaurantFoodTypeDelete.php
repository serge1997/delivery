<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Http\Resources\RestaurantFoodTypeResource;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeDelete
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository
    )
    {}

    public function run(int $id)
    {
        $restaurantFoodType = $this->restaurantFoodTypeRepository->find($id);
        $this->restaurantFoodTypeRepository->delete($restaurantFoodType);
        return new RestaurantFoodTypeResource($restaurantFoodType);
    }
}
