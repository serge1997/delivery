<?php
namespace App\Main\Category\Actions;

use App\Http\Resources\CategoryResource;
use App\Main\Category\Exception\CategoryException;
use Illuminate\Foundation\Http\FormRequest;
use App\Main\Category\Repository\CategoryRepositoryInterface;

class CategoryCreate
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function run(FormRequest $request)
    {
        $category = $this->categoryRepository->findByName($request->name());
        if (empty($category)){
            return new CategoryResource(
                $this->categoryRepository->create($request->validated())
            );
        }
        throw new CategoryException("La categorie {$request->name()} exist déja");
    }
}
