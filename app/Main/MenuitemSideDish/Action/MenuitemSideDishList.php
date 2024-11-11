<?php
namespace App\Main\MenuitemSideDish\Actions;

use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;

class MenuitemSideDishList
{
    public function __construct(
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository
    )
    {}
}
