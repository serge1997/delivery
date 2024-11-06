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
    public function update(Menuitem $menuitem, $request)
    {
        $data = [];
        if($menuitem->price != $request->price) $data['price'] = $request->price;
        if($menuitem->name != $request->name) $data['name'] = $request->name;
        if($menuitem->description != $request->description) $data['description'] = $request->description;
        if ($menuitem->restaurant_food_type_id != $menuitem->restaurant_food_type_id) $data['restaurant_food_type_id'] = $request->restaurant_food_type_id;
        if($menuitem->restaurant_category_id != $request->restaurant_category_id) $data['restaurant_category_id'] = $request->restaurant_category_id;
        $menuitem->is_active = $request->is_active;
        $menuitem->update($data);

        return $menuitem;
    }
    public function toggleIsActive(Menuitem $menuitem)
    {
        $menuitem->update([
            'is_active' => !$menuitem->is_active
        ]);
        return $menuitem;
    }
}
