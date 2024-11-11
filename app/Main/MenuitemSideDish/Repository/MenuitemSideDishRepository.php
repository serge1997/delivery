<?php
namespace App\Main\MenuitemSideDish\Repository;

use App\Models\Menuitem;
use App\Models\MenuitemSideDish;
use App\Models\Restaurant;
use App\Models\SideDish;

class MenuitemSideDishRepository implements MenuitemSideDishRepositoryInterface
{

    public function create($request, Menuitem $menuitem)
    {
        $sideDishes = [];
        foreach($request->sideDish() as $side_dish){
            if ($menuitem->menuitemSideDishes()->where('side_dish_id', $side_dish)->exists()){
                continue;
            }
            $side_dish [] = [
                'side_dish_id' => $side_dish
            ];
        }
        $menuitem->menuitemSideDishes()->saveMany($sideDishes);
        return $menuitem->menuitemSideDishes();
    }
    public function exists(Menuitem $menuitem, SideDish $sideDish)
    {
        return MenuitemSideDish::where([['menuitem_id', $menuitem->id], ['side_dish_id', $sideDish->id]])
            ->exists();
    }
}
