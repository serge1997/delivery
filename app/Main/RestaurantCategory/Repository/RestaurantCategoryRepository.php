<?php
namespace App\Main\RestaurantCategory\Repository;

use App\Main\RestaurantCategory\Exception\RestaurantCategoryException;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;

class RestaurantCategoryRepository implements RestaurantCategoryRepositoryInterface
{

    public function create($request, Restaurant $restaurant)
    {
        foreach($request->categoriesIds() as $categoryId){
            $restaurantCategory = new RestaurantCategory();
            if ($this->entityExist($restaurant->id, $categoryId)) {
                throw new RestaurantCategoryException("category exists déjá");
            }
            $restaurantCategory->restaurant_id = $restaurant->id;
            $restaurant->category_id = $categoryId;
            $restaurantCategory->save();
        }
        return $this->findByRestaurantId($restaurant);
    }

    public function findByRestaurantId(Restaurant $restaurant)
    {
        return RestaurantCategory::where('restaurant_id', $restaurant->id)->get();
    }

    public function entityExist(int $restaurant_id, int $category_id) : bool
    {
        return RestaurantCategory::where([['restaurant_id', $restaurant_id], ['category_id', $category_id]])->exists();
    }
}
