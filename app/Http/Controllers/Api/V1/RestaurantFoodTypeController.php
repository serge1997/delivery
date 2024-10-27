<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantFoodTypeRequest;
use App\Main\RestaurantFoodType\Actions\RestaurantFoodTypeCreate;
use App\Main\RestaurantFoodType\Actions\RestaurantFoodTypeList;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class RestaurantFoodTypeController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function store(RestaurantFoodTypeRequest $request): JsonResponse
    {
        try{
            /** @var RestaurantFoodTypeCreate $restuarantFoodTypeCreate */
            $restuarantFoodTypeCreate = $this->container->get(RestaurantFoodTypeCreate::class);
            $response = $restuarantFoodTypeCreate->run($request);
            $message = "type de plats crée avec succes";
            return response()
                ->json($this->successResponse($message, $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function listByRestaurant(int $restaurant_id)
    {
        try{
            /** @var RestaurantFoodTypeList $restaurantFoodTypeList */
            $restaurantFoodTypeList = $this->container->get(RestaurantFoodTypeList::class);
            $response = $restaurantFoodTypeList->listByRestaurantId($restaurant_id);
            $message = "list de tous vos types de plats";
            return response()
                ->json($this->successResponse($message, $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
