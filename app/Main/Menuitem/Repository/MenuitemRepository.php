<?php
namespace App\Main\Menuitem\Repository;

use App\Service\Base\BaseRepository;
use App\Models\Menuitem;
class MenuitemRepository extends BaseRepository implements MenuitemRepositoryInterface
{
    public function create($request)
    {
        $menuitem = new Menuitem($request->all());
        $image = $this->uploadImages($request, "image", "images/menuitems", ['jpeg', 'png', 'jpg']);
        if (is_string($image)) $menuitem->image = $image;
        $menuitem->save();
        return $menuitem;
    }
    public function find(int $id)
    {
        return Menuitem::find($id);
    }
    public function findAllByAuthRestaurant(int $restaurant_id)
    {
        return Menuitem::where('restaurant_id', $restaurant_id)
            ->get();
    }

    public function findAllActivesByRestaurant(int $restaurant_id)
    {
        return Menuitem::where([['is_active', true], ['restaurant_id', $restaurant_id]])
            ->get();
    }
}
