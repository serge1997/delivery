<?php
namespace App\Main\Category\Repository;

use App\Main\Category\Exception\CategoryException;
use App\Models\Category;
use App\Service\Base\BaseRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Traits\Conditionable;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    use Conditionable;
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
    public function listAllActives()
    {
        return Category::where('is_active', true)->get();
    }
    public function find(int $id)
    {
        return Category::find($id);
    }
    public function findByName(string $name)
    {
        return Category::where('name', $name)->first();
    }
    public function update(FormRequest $request)
    {
        $category = $this->find($request->id());
        $category->update([
            "name" => $request->name(),
            "description" => $request->description(),
            "is_active" => $request->isActive()
        ]);
        return $category;
    }
    public function updateImage($request)
    {
        $category = $this->find($request->id);
        $image = $this->uploadImages($request, "image", "images/categories");
        if (is_string($image)){
            unlink("images/categories/".$category->image);
            $category->update([
                "image" => $image
            ]);
            return $category;
        }
        throw new CategoryException("Aucune image selectionnée");
    }

    public function handleUpdateIsActive(Category $category)
    {
        $category->update([
            "is_active" => !$category->is_active
        ]);

        return $category;
    }

    public function findAllNotBelongsToCurrentRestaurant(int $restaurant_id)
    {
        return Category::where("is_active", true)
            ->whereNotIn('id', function($query) use($restaurant_id){
                $query->select('category_id')
                    ->from('restaurants_categories')
                        ->where('restaurant_id', $restaurant_id);
            })->get();
    }
}
