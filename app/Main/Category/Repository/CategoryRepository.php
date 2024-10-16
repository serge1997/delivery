<?php
namespace App\Main\Category\Repository;

use App\Main\Category\Exception\CategoryException;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(FormRequest $request) : Category
    {
        $category = new Category($request->all());
        if ($request->hasFile("image") && $request->file("image")->isValid()) {
            $image = $request->image();
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName()) . strtotime("now") .".". $extension;
            $image->move(public_path("images/categories"), $imageName);
            $category->image = $imageName;
        }
        $category->is_active = $request->isActive();
        $category->save();
        return $category;
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
