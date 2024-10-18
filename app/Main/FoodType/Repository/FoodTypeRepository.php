<?php
namespace App\Main\FoodType\Repository;
use App\Models\FoodType;
class FoodTypeRepository implements FoodTypeRepositoryInterface
{

    public function create(array $data): FoodType
    {
        return FoodType::create($data);
    }

    public function find(int $id): FoodType
    {
        return FoodType::find($id);
    }

    public function findByName(string $name): ?FoodType
    {
        return FoodType::where('name', $name)->first();
    }

    public function listAll()
    {
        return FoodType::all();
    }
}