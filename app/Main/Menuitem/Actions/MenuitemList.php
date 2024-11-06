<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Models\RestaurantFoodType;

class MenuitemList
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository,
        private RestaurantFoodType $restaurantFoodTypeRepository
    ){}

    public function listAllByAuthRestaurant(int $restaurant_id)
    {
        return MenuitemResource::collection(
            $this->menuitemRepository->findAllByAuthRestaurant($restaurant_id)
        );
    }
    public function listAllActivesByRestaurant(int $restaurant_id)
    {
        return MenuitemResource::collection(
            $this->menuitemRepository->findAllActivesByRestaurant($restaurant_id)
        );
    }
    public function listById(int $id)
    {
        return new MenuitemResource(
            $this->menuitemRepository->find($id)
        );
    }

    public function listAllByRestaurantFoodType(int $restaurant_food_type_id)
    {
        $restaurantFoodType = $this->restaurantFoodTypeRepository->find($restaurant_food_type_id);
        return MenuitemResource::collection(
            $this->menuitemRepository->findAllByRestaurantFoodType($restaurantFoodType)
        );
    }
}
