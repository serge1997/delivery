<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Main\Municipality\Actions\MunicipalityList;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class MunicipalityController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    ){}

    public function index()
    {
        try{
            /** @var MunicipalityList $municipalityList */
            $municipalityList = $this->container->get(MunicipalityList::class);
            $response = $municipalityList->listAll();
            return response()
                ->json($this->successResponse('list de toutes les communes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id)
    {
        try{
            /** @var MunicipalityList $municipalityList */
            $municipalityList = $this->container->get(MunicipalityList::class);
            $response = $municipalityList->listById($id);
            return response()
                ->json($this->successResponse("montrant une commune", $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function listByCity(int $city_id)
    {
        try{
            /** @var MunicipalityList $municipalityList */
            $municipalityList = $this->container->get(MunicipalityList::class);
            $response = $municipalityList->listAllByCity($city_id);
            return response()
                ->json($this->successResponse('list de toutes les communes par ville', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
