<?php
namespace App\Main\Menuitem\Actions;

use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;

class MenuitemList
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository
    ){}
}
