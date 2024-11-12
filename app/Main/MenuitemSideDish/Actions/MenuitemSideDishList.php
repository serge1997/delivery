<?php
namespace App\Main\MenuitemSideDish\Actions;

use App\Http\Resources\MenuitemSideDishResource;
use App\Main\Menuitem\Repository\MenuitemRepository;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;

class MenuitemSideDishList
{
    public function __construct(
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository,
        private MenuitemRepositoryInterface $menuitemRepository
    )
    {}

    public function listAllByMenuitem(int $menuitem_id)
    {
        $menuitem = $this->menuitemRepository->find($menuitem_id);
        return MenuitemSideDishResource::collection(
            $this->menuitemSideDishRepository->findAllByMenuitem($menuitem)
        );
    }
}
