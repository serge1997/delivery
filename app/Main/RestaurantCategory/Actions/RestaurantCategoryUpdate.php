<?php
namespace App\Main\RestaurantCategory\Actions;

use App\Http\Resources\RestaurantCategoryResource;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;

class RestaurantCategoryUpdate
{
    public function __construct(
        private RestaurantCategoryRepositoryInterface $restaurantCategoryRepository
    ){}

    public function handleToggleIsActive(int $id)
    {
        $restaurantCategory = $this->restaurantCategoryRepository->find($id);
        return new RestaurantCategoryResource(
            $this->restaurantCategoryRepository->toggleIsActive($restaurantCategory)
        );
    }
}
