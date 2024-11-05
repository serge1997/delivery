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
        if(!empty($request->food_type) && $menuitem->restaurant_food_type_id != $request->food_type){
            $data['restaurant_food_type_id'] = $$request->food_type;
        }
        if($menuitem->price != $request->price) $data['price'] = $request->price;
        if($menuitem->name != $request->name) $data['name'] = $request->name;
        if($menuitem->description != $request->description) $data['description'] = $request->description;

        if($menuitem->restaurant_category_id != $request->category_id) $data['restaurant_category_id'] = $request->category_id;
        $menuitem->is_active = $request->is_active;
        $menuitem->update($data);

        return $menuitem;
    }
}
