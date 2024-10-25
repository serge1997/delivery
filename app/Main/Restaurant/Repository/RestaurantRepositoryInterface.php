<?php
namespace App\Main\Restaurant\Repository;
use App\Models\Restaurant;
interface RestaurantRepositoryInterface
{
    public function create(array $data);
    public function findAllActives();
    public function findByNameAndPhone(string $name, string $phone) : ?Restaurant;
    public function find(int $id) : Restaurant;
    public function updateImages($request);
}
