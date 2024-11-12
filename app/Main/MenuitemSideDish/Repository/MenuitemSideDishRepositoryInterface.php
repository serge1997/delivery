<?php
namespace App\Main\MenuitemSideDish\Repository;

use App\Models\Menuitem;
use App\Models\MenuitemSideDish;
use App\Models\Restaurant;
use App\Models\SideDish;

interface MenuitemSideDishRepositoryInterface
{
    public function create($request, Menuitem $menuitem);
    public function exists(Menuitem $menuitem, SideDish $sideDish);
    public function findAllByMenuitem(Menuitem $menuitem);
    public function find(int $id) : MenuitemSideDish;
    public function delete(MenuitemSideDish $menuitemSideDish) : MenuitemSideDish;
}
