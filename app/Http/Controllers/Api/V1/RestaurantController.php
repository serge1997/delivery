<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Main\Restaurant\Actions\RestaurantCreate;
use App\Main\Restaurant\Actions\RestaurantList;
use App\Main\Restaurant\Actions\RestaurantUpdate;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class RestaurantController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function index()
    {
        try{
            /** @var RestaurantList $restaurantList */
            $restaurantList = $this->container->get(RestaurantList::class);
        }catch(\Exception $e){

        }
    }
    public function store(RestaurantRequest $request)
    {
        try{
            $request->validated();
            /** @var RestaurantCreate $restaurantCreate */
            $restaurantCreate = $this->container->get(RestaurantCreate::class);
            $restaurant = $restaurantCreate->run($request);
            return response()
                ->json($this->successResponse('établissement enregistré avec succes', $restaurant));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show($id)
    {
        try{
            /** @var RestaurantList $restaurantList */
            $restaurantList = $this->container->get(RestaurantList::class);
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function update(RestaurantRequest $request)
    {
        try{
            /** @var RestaurantUpdate $restaurantUpdate */
            $restaurantUpdate = $this->container->get(RestaurantUpdate::class);
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function updateImages(Request $request)
    {
        try{
            /** @var RestaurantUpdate $restaurantUpdate */
            $restaurantUpdate = $this->container->get(RestaurantUpdate::class);
        }catch(Exception $e) {
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function getAllActives() : JsonResponse
    {
        try{

            /** @var RestaurantList $restaurantList */
            $restaurantList = $this->container->get(RestaurantList::class);
            $response = $restaurantList->listAllActives();
            return response()
                ->json($this->successResponse('list de tous les restaurants actives', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
