<?php
namespace App\Main\FoodType\Repository;

use App\Models\FoodType;

interface FoodTypeRepositoryInterface
{
    public function create(array $data): FoodType;
    public function find(int $id): FoodType;
    public function findByName(string $name): ?FoodType;
    public function listAll();
}