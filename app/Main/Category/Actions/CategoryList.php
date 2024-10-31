<?php
namespace App\Main\Category\Actions;

use App\Http\Resources\CategoryResource;
use App\Main\Category\Repository\CategoryRepositoryInterface;
class CategoryList
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function listAll()
    {
        return CategoryResource::collection(
            $this->categoryRepository->listAll()
        );
    }

    public function findById(int $id)
    {
        return new CategoryResource(
            $this->categoryRepository->find($id)
        );
    }
    public function listAllActives()
    {
        return CategoryResource::collection(
            $this->categoryRepository->listAllActives()
        );
    }
    public function listAllNotBelongsToCurrentRestaurant(int $restaurant_id)
    {
        return CategoryResource::collection(
            $this->categoryRepository->findAllNotBelongsToCurrentRestaurant($restaurant_id)
        );
    }
}
