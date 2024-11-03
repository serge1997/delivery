<?php
namespace App\Main\Menuitem\Repository;

interface MenuitemRepositoryInterface
{
    public function create($request);
    public function find(int $id);
    public function findAllByAuthRestaurant(int $restaurant_id);
    public function findAllActivesByRestaurant(int $restaurant_id);
}
