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
        foreach($request->sideDishes() as $side_dish){
            if (!$menuitem->menuitemSideDishes()->where([['side_dishe_id', $side_dish], ['menuitem_id', $menuitem->id]])->exists()){
                $sideDishes [] = new MenuitemSideDish(['side_dishe_id' => $side_dish]);
            }
        }
        $menuitem->menuitemSideDishes()->saveMany($sideDishes);
        return $menuitem->menuitemSideDishes();
    }
    public function find(int $id) : MenuitemSideDish
    {
        return MenuitemSideDish::find($id);
    }
    public function exists(Menuitem $menuitem, SideDish $sideDish)
    {
        return MenuitemSideDish::where([['menuitem_id', $menuitem->id], ['side_dish_id', $sideDish->id]])
            ->exists();
    }

    public function findAllByMenuitem(Menuitem $menuitem)
    {
        return MenuitemSideDish::where('menuitem_id', $menuitem->id)
            ->get();
    }

    public function delete(MenuitemSideDish $menuitemSideDish) : MenuitemSideDish
    {
        $menuitemSideDish->delete();
        return $menuitemSideDish;
    }

}
