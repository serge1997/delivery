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
}
