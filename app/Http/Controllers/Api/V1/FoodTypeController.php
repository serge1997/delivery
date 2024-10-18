<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodTypeRequest;
use App\Main\FoodType\Actions\FoodTypeCreate;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Psr\Container\ContainerInterface;
use App\Main\FoodType\Actions\FoodTypeList;
use App\Main\FoodType\Actions\FoodTypeUpdate;

class FoodTypeController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function index() : JsonResponse
    {
        try{
            /** @var FoodTypeList $foodTypeList */
            $foodTypeList = $this->container->get(FoodTypeList::class);
            $response = $foodTypeList->listAll();
            return response()
                ->json($this->successResponse("List de tous les types de plats", $response));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function listAllActives() : JsonResponse
    {
        try{
            /** @var FoodTypeList $foodTypeList */
            $foodTypeList = $this->container->get(FoodTypeList::class);
            $response = $foodTypeList->listAllActives();
            return response()
                ->json($this->successResponse("List de tous les types de plats actives", $response));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function store(FoodTypeRequest $request) : JsonResponse
    {
        try{
            $request->validated();
            /** @var FoodTypeCreate $foodTypeCreate */
            $foodTypeCreate = $this->container->get(FoodTypeCreate::class);
            $data = $foodTypeCreate->run($request);
            return response()
                ->json($this->successResponse("Type de plat creé avec succes", $data));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function show(int $id) : JsonResponse
    {
        try{
            /** @var FoodTypeList $foodTypeList */
            $foodTypeList = $this->container->get(FoodTypeList::class);
            $foodType = $foodTypeList->findById($id);
            return response()
                ->json($this->successResponse("Info du type de plat", $foodType));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function update(FoodTypeRequest $request) : JsonResponse
    {
        try{
            /** @var FoodTypeUpdate $foodTypeList */
            $foodTypeUpdate = $this->container->get(FoodTypeUpdate::class);
            $foodType = $foodTypeUpdate->run($request);
            return response()
                ->json($this->successResponse("type de plat actualisé avec succes", $foodType));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function handleIsActive(int $id) : JsonResponse
    {
        try{
            /** @var FoodTypeUpdate $foodTypeList */
            $foodTypeUpdate = $this->container->get(FoodTypeUpdate::class);
            $foodType = $foodTypeUpdate->handleIsActive($id);
            return response()
                ->json($this->successResponse("status actualisé avec succes", $foodType));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
