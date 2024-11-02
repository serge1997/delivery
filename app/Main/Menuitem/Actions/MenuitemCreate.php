<?php
namespace App\Main\Menuitem\Actions;

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

    }
}
