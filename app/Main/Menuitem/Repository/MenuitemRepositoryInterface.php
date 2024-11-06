<?php
namespace App\Main\Menuitem\Repository;

use App\Models\Menuitem;

interface MenuitemRepositoryInterface
{
    public function create($request);
    public function find(int $id);
    public function findAllByAuthRestaurant(int $restaurant_id);
    public function findAllActivesByRestaurant(int $restaurant_id);
    public function update(Menuitem $menuitem, $request);
    public function toggleIsActive(Menuitem $menuitem);
}
