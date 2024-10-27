<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;

class RestaurantFoodTypeDelete
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $foodTypeRepository
    )
    {}

    public function run(int $id): void
    {

    }
}
