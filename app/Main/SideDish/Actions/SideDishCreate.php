<?php
namespace App\Main\SideDish\Actions;

use App\Http\Resources\SideDishResource;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use App\Main\SideDish\Repository\SideDishRepositoryInterface;
use App\Main\SideDish\Exception\SideDishException;
use Illuminate\Foundation\Http\FormRequest;

class SideDishCreate
{
    public function __construct(
        private SideDishRepositoryInterface $sideDishRepository,
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}

    public function run(FormRequest $request, $restaurant_id)
    {
        $restaurant = $this->restaurantRepository->find($restaurant_id);
        $exists = $this->sideDishRepository->findByRestaurantAndName($request->name(), $restaurant);
       if (!$exists){
            return new SideDishResource(
                $this->sideDishRepository->create($request, $restaurant)
            );
       }
       throw new SideDishException("vous avez deja enregistré cet accompagnement dans le systeme");
    }
}
