<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
use App\Main\Menuitem\Exception\MenuitemException;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class MenuitemUpdate
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $menuitem = $this->menuitemRepository->find($request->id);
        if (!$menuitem) {
            throw new MenuitemException("Identificateur du menu n'existe pas");
        }
        return new MenuitemResource(
            $this->menuitemRepository->update($menuitem, $request)
        );
    }
}
