<?php
namespace App\Main\RestaurantCategory\Actions;

use App\Http\Resources\RestaurantCategoryResource;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use App\Main\RestaurantCategory\Exception\RestaurantCategoryException;
use App\Main\RestaurantCategory\Repository\RestaurantCategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantCategoryCreate
{
    public function __construct(
        private RestaurantCategoryRepositoryInterface $restaurantCategoryRepository,
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $restaurant = $this->restaurantRepository->find($request->restaurantId());
        $persist = $this->restaurantCategoryRepository->create($request, $restaurant);
        if (!$persist){
            throw new RestaurantCategoryException("Une erreure est survenue");
        }
        return RestaurantCategoryResource::collection($persist);
    }
}
