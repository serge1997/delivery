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
    public function show() : JsonResponse
    {
        try{
            /** @var FoodTypeList $foodTypeList */
            $foodTypeList = $this->container->get(FoodTypeList::class);
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
