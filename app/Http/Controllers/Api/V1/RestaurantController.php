<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Main\Restaurant\Actions\RestaurantCreate;
use App\Main\Restaurant\Actions\RestaurantList;
use App\Main\Restaurant\Actions\RestaurantUpdate;
use App\Traits\HttpResponse;
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
            /** @var RestaurantCreate $restaurantCreate */
            $restaurantCreate = $this->container->get(RestaurantCreate::class);
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id)
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
}
