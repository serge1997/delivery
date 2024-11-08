<?php
namespace App\Main\SideDish\Repository;

use App\Models\SideDish;
use App\Service\Base\BaseRepository;
use App\Models\Restaurant;
class SideDishRepository extends BaseRepository implements SideDishRepositoryInterface
{

    public function create($request)
    {
        return SideDish::created($request->all());
    }
    public function findAllByRestaurant(int $restaurant_id)
    {
        return SideDish::where('restaurant_id', $restaurant_id)
            ->get();
    }
    public function findByRestaurantAndName(string $name, Restaurant $restaurant)
    {
        return SideDish::where([['name', $name], ['restaurant_id', $restaurant->id]])
            ->first();
    }
}
