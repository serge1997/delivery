<?php
namespace App\Main\Category\Actions;

use App\Main\Category\Repository\CategoryRepositoryInterface;
class CategoryUpdate
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    )
    {

    }
}
