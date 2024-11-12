<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
use App\Main\Menuitem\Exception\MenuitemException;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use App\Main\MenuitemSideDish\Repository\MenuitemSideDishRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class MenuitemUpdate
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository,
        private MenuitemSideDishRepositoryInterface $menuitemSideDishRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $menuitem = $this->menuitemRepository->find($request->id);
        if (!$menuitem) {
            throw new MenuitemException("Identificateur du menu n'existe pas");
        }
        if ($request->filled('side_dishes_id')){
            $this->menuitemSideDishRepository->create($request, $menuitem);
        }
        return new MenuitemResource(
            $this->menuitemRepository->update($menuitem, $request)
        );
    }

    public function handleToggleIsActive(int $id)
    {
        $menuitem = $this->menuitemRepository->find($id);
        if (!$menuitem) {
            throw new MenuitemException("Identificateur introuvable");
        }
        return new MenuitemResource(
            $this->menuitemRepository->toggleIsActive($menuitem)
        );
    }
}
