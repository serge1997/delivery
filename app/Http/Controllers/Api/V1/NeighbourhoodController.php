<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Main\Municipality\Actions\MunicipalityList;
use App\Main\Neighbourhood\Actions\NeighbourhoodList;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class NeighbourhoodController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    ){}

    public function index()
    {
        try{
            /** @var NeighbourhoodList $neighbourhoodList */
            $neighbourhoodList = $this->container->get(MunicipalityList::class);
            $response = $neighbourhoodList->listAll();
            return response()
                ->json($this->successResponse('list de tous les quartiers', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function store()
    {
        try{

        }catch(Exception $e){

        }
    }

    public function show(int $id)
    {
        try{
            /** @var NeighbourhoodList $neighbourhoodList */
            $neighbourhoodList = $this->container->get(MunicipalityList::class);
            $response = $neighbourhoodList->listById($id);
            return response()
                ->json($this->successResponse('monstrant un quartier', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function listByMunicpality(int $municiapality_id)
    {
        try{
             /** @var NeighbourhoodList $neighbourhoodList */
             $neighbourhoodList = $this->container->get(MunicipalityList::class);
             $response = $neighbourhoodList->listAllByMunicpality($municiapality_id);
             return response()
                 ->json($this->successResponse('monstrant les quartiers par communes', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
