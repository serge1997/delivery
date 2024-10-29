<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCategoryRequest;
use App\Main\RestaurantCategory\Actions\RestaurantCategoryCreate;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class RestaurantCategoryController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function store(RestaurantCategoryRequest $request)
    {
        try{
            $request->validated();
            /** @var RestaurantCategoryCreate $restaurantCategoryCreate */
            $restaurantCategoryCreate = $this->container->get(RestaurantCategoryCreate::class);
            $response = $restaurantCategoryCreate->run($request);
            return response()
                ->json($this->successResponse('categories enregistrées avec succes', $response));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
