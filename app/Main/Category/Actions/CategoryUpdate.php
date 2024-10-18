<?php
namespace App\Main\Category\Actions;

use App\Http\Resources\CategoryResource;
use App\Main\Category\Repository\CategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Traits\Conditionable;

class CategoryUpdate
{
    use Conditionable;
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    )
    {}

    public function run(FormRequest $request)
    {
        return new CategoryResource(
            $this->categoryRepository->update($request)
        );
    }

    public function updateImage($request)
    {
        return new CategoryResource(
            $this->categoryRepository->updateImage($request)
        );
    }
    public function handleIsActive($id)
    {
        $category = $this->categoryRepository->find($id);
        return new CategoryResource(
            $this->categoryRepository->handleUpdateIsActive($category)
        );
    }
}
