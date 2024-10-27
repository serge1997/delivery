<?php
namespace App\Main\RestaurantFoodType\Actions;

use App\Http\Resources\RestaurantFoodTypeResource;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use App\Main\RestaurantFoodType\Exception\RestaurantFoodTypeException;
use App\Main\RestaurantFoodType\Repository\RestaurantFoodTypeRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantFoodTypeCreate
{
    public function __construct(
        private RestaurantFoodTypeRepositoryInterface $restaurantFoodTypeRepository,
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $restaurant = $this->restaurantRepository->find($request->restaurantId());
        if ($restaurant->isNot($request->user())){
            throw new RestaurantFoodTypeException("Les données de votre établissement sont invalides");
        }
        $restaurantFoodTypes = $this->restaurantFoodTypeRepository->create(
            $request,
            $restaurant
        );
        if (!$restaurantFoodTypes){
            throw new RestaurantFoodTypeException("Une erreure est survenue, verifier vos données");
        }
        return RestaurantFoodTypeResource::collection($restaurantFoodTypes);

    }
}
