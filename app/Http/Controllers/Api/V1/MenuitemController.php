<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuitemRequest;
use App\Main\Menuitem\Actions\MenuitemCreate;
use App\Main\Menuitem\Actions\MenuitemList;
use App\Main\Menuitem\Actions\MenuitemUpdate;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class MenuitemController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function store(MenuitemRequest $request)
    {
        try{
            /** @var MenuitemCreate $menuitemCreate */
            $menuitemCreate = $this->container->get(MenuitemCreate::class);
            $response = $menuitemCreate->run($request);
            return response()
                ->json($this->successResponse('item enregistré avec success', $response));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function getAllByAuthRestaurant(Request $request)
    {
        try{
            /** @var MenuitemList $menuitemList */
            $menuitemList = $this->container->get(MenuitemList::class);
            $auth_restaurant_id = $request->session()->get('auth_restaurant');
            $response = $menuitemList->listAllByAuthRestaurant($auth_restaurant_id);
            return response()
                ->json($this->successResponse('list de menu par restaurant', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function getAllActivesByRestaurant(int $restaurant_id)
    {
        try{
            /** @var MenuitemList $menuitemList */
            $menuitemList = $this->container->get(MenuitemList::class);
            $response = $menuitemList->listAllActivesByRestaurant($restaurant_id);
            return response()
                ->json($this->successResponse('list de menu active par restaurant', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function show(int $id)
    {
        try{
            /** @var MenuitemList $menuitemList */
            $menuitemList = $this->container->get(MenuitemList::class);
            $response = $menuitemList->listById($id);
            return response()
                ->json($this->successResponse("list d'un item de menu", $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function update(MenuitemRequest $request)
    {
        try{
            /** @var MenuitemUpdate $menuitemUpdate  */
            $menuitemUpdate = $this->container->get(MenuitemUpdate::class);
            $response = $menuitemUpdate->run($request);
            return response()
                ->json($this->successResponse("l'item du menu actualisé avec succes", $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function toggleIsActive(int $id)
    {
        try{
            /** @var MenuitemUpdate $menuitemUpdate */
            $menuitemUpdate = $this->container->get(MenuitemUpdate::class);
            $data = $menuitemUpdate->handleToggleIsActive($id);
            return response()
                ->json($this->successResponse('status actualisé avec succes', $data));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function getAllByRestaurantFoodType(int $restaurant_food_type_id)
    {
        try{
            /** @var MenuitemList $menuitemList */
            $menuitemList = $this->container->get(MenuitemList::class);
            $response = $menuitemList->listAllByRestaurantFoodType($restaurant_food_type_id);
            return response()
                ->json($this->successResponse("tous les menu par type de plats", $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 404);
        }
    }

    public function getAllCartItems(Request $request)
    {
        try{
            /** @var MenuitemList $menuitemSideDishList */
            $menuitemSideDishList = $this->container->get(MenuitemList::class);
            $data = $menuitemSideDishList->listCartItems($request->cart_items);
            return response()
                ->json($this->successResponse('list panier de commande', $data));

        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
