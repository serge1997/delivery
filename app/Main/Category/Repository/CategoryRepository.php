<?php
namespace App\Main\Category\Repository;

use App\Main\Category\Exception\CategoryException;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data) : Category
    {
        return Category::create($data);
    }
    public function listAll()
    {
        return Category::all();
    }
    public function find(int $id)
    {
        return Category::find($id);
    }
    public function findByName(string $name)
    {
        return Category::where('name', $name)->first();
    }
    public function update($request)
    {
        throw new CategoryException("Method doesnt implmented");
    }
}
