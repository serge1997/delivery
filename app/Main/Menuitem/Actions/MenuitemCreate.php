<?php
namespace App\Main\Menuitem\Actions;

use App\Http\Resources\MenuitemResource;
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
        return new MenuitemResource(
            $this->menuitemRepository->create($request)
        );
    }
}
