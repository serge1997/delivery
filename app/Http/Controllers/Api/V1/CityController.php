<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Main\City\Actions\CityList;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class CityController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    ){}

    public function index()
    {
        try{
            /** @var CityList $cityList */
            $cityList = $this->container->get(CityList::class);
            $response = $cityList->listAll();
            return response()
                ->json($this->successResponse('list de toutes les villes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id)
    {
        try{
            /** @var CityList $cityList */
            $cityList = $this->container->get(CityList::class);
            $response = $cityList->listById($id);
            return response()
                ->json($this->successResponse('list de toutes les villes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
