<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
use App\Main\Menuitem\Exception\MenuitemException;
use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class MenuitemCreate
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $request->validated();
        $session_auth = $request->session()->get("auth_restaurant");
        if ($session_auth != $request->restaurant_id) {
            throw new MenuitemException("Action não realizable. rentrez en contact avec le support");
        }
        if ($request->filled('')){

        }
        return new MenuitemResource(
            $this->menuitemRepository->create($request)
        );
    }
}
