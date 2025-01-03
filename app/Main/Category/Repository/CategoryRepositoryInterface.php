<?php
namespace App\Main\Category\Repository;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

interface CategoryRepositoryInterface
{
    public function create(FormRequest $request) : Category;
    public function listAll();
    public function listAllActives();
    public function find(int $id) : Category;
    public function findByName(string $name) : ?Category;
    public function update(FormRequest $request);
    public function updateImage($request);
    public function handleUpdateIsActive(Category $category);
    public function findAllNotBelongsToCurrentRestaurant(int $restaurant_id);
}
