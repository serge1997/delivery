<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCategoryRequest;
use App\Main\RestaurantCategory\Actions\RestaurantCategoryCreate;
use App\Main\RestaurantCategory\Actions\RestaurantCategoryDelete;
use App\Main\RestaurantCategory\Actions\RestaurantCategoryList;
use App\Main\RestaurantCategory\Actions\RestaurantCategoryUpdate;
use App\Traits\HttpResponse;
use Exception;
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

    public function getByRestaurant(int $id)
    {
        try{
            /** @var RestaurantCategoryList $restaurantCategoryList */
            $restaurantCategoryList = $this->container->get(RestaurantCategoryList::class);
            $response = $restaurantCategoryList->listByRestaurantId($id);
            return response()
                ->json($this->successResponse('list des categories par restaurant', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 404);
        }
    }

    public function delete(int $id)
    {
        try{
            /** @var RestaurantCategoryDelete $restaurantCategoryDelete */
            $restaurantCategoryDelete = $this->container->get(RestaurantCategoryDelete::class);
            $response = $restaurantCategoryDelete->remove($id);
            return response()
                ->json($this->successResponse('Categorie supprimée avec succes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function handleToggleIsActive(int $id)
    {
        try{
            /** @var RestaurantCategoryUpdate $restaurantCategoryUpdate */
            $restaurantCategoryUpdate = $this->container->get(RestaurantCategoryUpdate::class);
            $response = $restaurantCategoryUpdate->handleToggleIsActive($id);
            return response()
                ->json($this->successResponse('status actualisé avec succes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
