<?php
namespace App\Main\SideDish\Actions;

use App\Http\Resources\SideDishResource;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Main\SideDish\Repository\SideDishRepositoryInterface;
use App\Models\Menuitem;

class SideDishList
{
    public function __construct(
        private SideDishRepositoryInterface $sideDishRepository,
        private MenuitemRepositoryInterface $menuitemRepository
    )
    {}

    public function listAllByAuthRestaurant(int $auth)
    {
        return SideDishResource::collection(
            $this->sideDishRepository->findAllByAuthRestaurant($auth)
        );
    }

    public function listAllNotBelongsToMenuitem(int $menuitem_id)
    {
        $menuitem = $this->menuitemRepository->find($menuitem_id);
        return SideDishResource::collection(
            $this->sideDishRepository->findAllNotBelongsToMenuitem($menuitem)
        );
    }
}
