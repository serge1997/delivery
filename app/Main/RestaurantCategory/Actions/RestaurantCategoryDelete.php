<?php
namespace App\Main\RestaurantCategory\Actions;

use App\Http\Resources\RestaurantCategoryResource;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;

class RestaurantCategoryDelete
{
    public function __construct(
        private RestaurantCategoryRepositoryInterface $restaurantCategoryRepository
    )
    {}

    public function remove(int $id)
    {
        $restaurantCategory = $this->restaurantCategoryRepository->find($id);
        return new RestaurantCategoryResource(
            $this->restaurantCategoryRepository->delete($restaurantCategory)
        );
    }
}
