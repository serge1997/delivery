<?php
namespace App\Main\MenuitemSideDish\Actions;

use App\Http\Resources\MenuitemSideDishResource;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Main\MenuitemSideDish\MenuitemSideDishException;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;
use App\Main\SideDish\Repository\SideDishRepositoryInterface;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class MenuitemSideDishCreate
{
    public function __construct(
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository,
        private MenuitemRepositoryInterface $menuitemRepository,
        private SideDishRepositoryInterface $sideDishRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $menuitem = $this->menuitemRepository->find($request->menuitem());
        $sideDish = $this->sideDishRepository->find($request->sideDish());

        if ($menuitem->restaurant->is($sideDish->restaurant)){
            $exists = $this->menuitemSideDishRepository->exists($menuitem, $menuitem->restaurant);
            if (!$exists){
                return new MenuitemSideDishResource(
                    $this->menuitemSideDishRepository->create($request)
                );
            }
            throw new MenuitemSideDishException("l'accompagnement existe déja sur cet item");
        }
        throw new MenuitemSideDishException("votre identificateur ne correspond pas a l'item du menu");

    }
}
