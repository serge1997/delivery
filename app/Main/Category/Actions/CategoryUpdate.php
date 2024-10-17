<?php
namespace App\Main\Category\Actions;

use App\Main\Category\Repository\CategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdate
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function run(FormRequest $request)
    {
        return $request;
    }
}
