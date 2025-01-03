<?php
namespace App\Main\SideDish\Repository;

use App\Models\SideDish;
use App\Service\Base\BaseRepository;
use App\Models\Restaurant;
use App\Models\Menuitem;
class SideDishRepository extends BaseRepository implements SideDishRepositoryInterface
{

    public function create($request) : SideDish
    {
        return SideDish::create($request->all());
    }
    public function findAllByAuthRestaurant(int $restaurant_id)
    {
        return SideDish::where('restaurant_id', $restaurant_id)
            ->get();
    }
    public function findByRestaurantAndName(string $name, Restaurant $restaurant) : ?SideDish
    {
        return SideDish::where([['name', $name], ['restaurant_id', $restaurant->id]])
            ->first();
    }

    public function find(int $id) : SideDish
    {
        return SideDish::find($id);
    }

    public function findAllNotBelongsToMenuitem(Menuitem $menuitem)
    {
        return SideDish::whereNotIn('id', function($query) use($menuitem) {
            $query->select('side_dishe_id')
                ->from('menuitem_side_dishes')
                    ->where('menuitem_id', $menuitem->id);
        })->get();
    }
}
