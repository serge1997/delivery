<?php
namespace App\Main\MenuitemSideDish\Actions;

use App\Http\Resources\MenuitemSideDishResource;
use App\Main\MenuitemSideDish\MenuitemSideDishException;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;

class MenuitemSideDishDelete
{
    public function __construct(
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository
    )
    {}

    public function run(int $id)
    {
        $sideDishMenuitem = $this->menuitemSideDishRepository->find($id);
        if (!$sideDishMenuitem){
            throw new MenuitemSideDishException("registre introuvable");
        }
        return new MenuitemSideDishResource(
            $this->menuitemSideDishRepository->delete($sideDishMenuitem)
        );
    }
}
