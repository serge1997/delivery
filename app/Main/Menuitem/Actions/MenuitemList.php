<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;

class MenuitemList
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository
    ){}

    public function listAllByAuthRestaurant(int $restaurant_id)
    {
        return MenuitemResource::collection(
            $this->menuitemRepository->findAllByAuthRestaurant($restaurant_id)
        );
    }
    public function listAllActivesByRestaurant(int $restaurant_id)
    {
        return MenuitemResource::collection(
            $this->menuitemRepository->findAllActivesByRestaurant($restaurant_id)
        );
    }
}
