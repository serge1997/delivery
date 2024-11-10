<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SideDishRequest;
use App\Main\SideDish\Actions\SideDishCreate;
use App\Main\SideDish\Actions\SideDishDelete;
use App\Main\SideDish\Actions\SideDishList;
use App\Main\SideDish\Actions\SideDishUpdate;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class SideDishController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function index()
    {

    }

    public function store(SideDishRequest $request)
    {
        try{
            $request->validated();
            /** @var SideDishCreate $sideDishCreate */
            $sideDishCreate = $this->container->get(SideDishCreate::class);
            $auth_restaurant = session('auth_restaurant');
            $response = $sideDishCreate->run($request, $auth_restaurant);
            return response()
                ->json($this->successResponse('acompaghement enregistre avec succes', $response));

        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function getByAuthRestaurant()
    {
        try{
            /** @var SideDishList $sideDishList */
            $sideDishList = $this->container->get(SideDishList::class);
        }catch(Exception $e){

        }
    }

    public function update(SideDishRequest $request)
    {
        try{
            /** @var SideDishUpdate $sideDishUpdate */
            $sideDisUpdate = $this->container->get(SideDishUpdate::class);
        }catch(Exception $e){

        }
    }

    public function delete()
    {
        try{
            /** @var SideDishDelete $sideDishDelete */
            $sideDishDelete = $this->container->get(SideDishDelete::class);
        }catch(Exception $e){

        }
    }
}
