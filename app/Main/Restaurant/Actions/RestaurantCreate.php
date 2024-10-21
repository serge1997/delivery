<?php
namespace App\Main\Restaurant\Actions;

use App\Http\Resources\RestaurantResource;
use App\Main\Restaurant\Exception\RestaurantException;
use App\Main\Restaurant\Repository\RestaurantRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantCreate
{
    public function __construct(
        private RestaurantRepositoryInterface $restaurantRepository
    )
    {}

    public function run(FormRequest $request)
    {
        $restaurant = $this->restaurantRepository->findByNameAndPhone($request->name(), $request->phone());
        if (!empty( $restaurant )) {
            throw new RestaurantException("Le restaurant exits dejá");
        }
        return new RestaurantResource(
            $this->restaurantRepository->create($request->validated())
        );
    }
}
