<?php
namespace App\Main\SideDish\Repository;

use App\Models\Restaurant;
use App\Models\SideDish;
use App\Models\Menuitem;
interface SideDishRepositoryInterface
{

    public function create($request) : SideDish;
    public function findAllByAuthRestaurant(int $restaurant_id);
    public function findByRestaurantAndName(string $name, Restaurant $restaurant) : ?SideDish;
    public function find(int $id) : SideDish;
    public function findAllNotBelongsToMenuitem(Menuitem $menuitem);
}
