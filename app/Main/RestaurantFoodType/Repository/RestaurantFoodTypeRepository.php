<?php
namespace App\Main\RestaurantFoodType\Repository;

use App\Models\Restaurant;
use App\Service\Base\BaseRepository;
use App\Models\RestaurantFoodType;

class RestaurantFoodTypeRepository extends BaseRepository implements RestaurantFoodTypeRepositoryInterface
{
    public function create($request, Restaurant $restaurant)
    {
        foreach($request->foodTypesId() as $food_type){
            $restaurantFoodType = new RestaurantFoodType();
            $restaurantFoodType->food_type_id = $food_type;
            $restaurantFoodType->restaurant_id = $restaurant->id;
            $restaurantFoodType->save();
        }
        return $this->findByRestaurantId($restaurant->id);
    }

    public function findByRestaurantId(int $id)
    {
        return RestaurantFoodType::where('restaurant_id', $id)->get();
    }
    public function find(int $id)
    {
        return RestaurantFoodType::find($id);
    }
    public function delete(RestaurantFoodType $restaurantFoodType)
    {
        $restaurantFoodType->delete();
    }
    public function handleToggleIsActive(RestaurantFoodType $restaurantFoodType)
    {
        $restaurantFoodType->update([
            'is_active' => !$restaurantFoodType->is_active
        ]);
        return $restaurantFoodType;
    }
}