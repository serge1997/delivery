<?php
namespace App\Main\FoodType\Repository;

use App\Models\FoodType;

interface FoodTypeRepositoryInterface
{
    public function create(array $data): FoodType;
    public function find(int $id): FoodType;
    public function findByName(string $name): ?FoodType;
    public function listAll();
    public function findAllNotBelongsToCurrentRestaurant(int $restaurant_id);
    public function update($request): FoodType;
    public function handleIsActive(FoodType $foodType): FoodType;
}
