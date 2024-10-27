<?php
namespace App\Main\FoodType\Actions;

use App\Http\Resources\FoodTypeResource;
use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;

class FoodTypeList
{
    public function __construct(
        private FoodTypeRepositoryInterface $foodTypeRepository
    ){}

    public function listAll()
    {
        return FoodTypeResource::collection(
            $this->foodTypeRepository->listAll()
        );
    }

    public function findById(int $id)
    {
        return new FoodTypeResource(
            $this->foodTypeRepository->find($id)
        );
    }

    public function listAllNotBelongsToCurrentRestaurant(int $restaurant_id)
    {
        return FoodTypeResource::collection(
            $this->foodTypeRepository->findAllNotBelongsToCurrentRestaurant($restaurant_id)
        );
    }
}
