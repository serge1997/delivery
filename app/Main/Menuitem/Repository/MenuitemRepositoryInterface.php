<?php
namespace App\Main\Menuitem\Repository;

interface MenuitemRepositoryInterface
{
    public function create($request);
    public function findAllByAuthRestaurant(int $restaurant_id);
}
