<?php
namespace App\Main\MenuitemSideDish\Repository;

use App\Models\Menuitem;
use App\Models\MenuitemSideDish;
use App\Models\Restaurant;
use App\Models\SideDish;

class MenuitemSideDishRepository implements MenuitemSideDishRepositoryInterface
{

    public function create($request)
    {
        return MenuitemSideDish::create($request->validated());
    }
    public function exists(Menuitem $menuitem, SideDish $sideDish)
    {
        return MenuitemSideDish::where([['menuitem_id', $menuitem->id], ['side_dish_id', $sideDish->id]])
            ->exists();
    }
}
