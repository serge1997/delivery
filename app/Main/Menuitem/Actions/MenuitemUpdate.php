<?php
namespace App\Main\Menuitem\Actions;

use App\Main\Menuitem\Repository\MenuitemRepositoryInterface;

class MenuitemUpdate
{
    public function __construct(
        private MenuitemRepositoryInterface $menuitemRepository
    )
    {}
}
