<?php
namespace App\Main\MenuitemSideDish\Actions;

use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;

class MenuitemSideDishDelete
{
    public function __construct(
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository
    )
    {}
}
