<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuitemSideDishRequest;
use App\Main\MenuitemSideDish\Actions\MenuitemSideDishCreate;
use App\Main\MenuitemSideDish\Actions\MenuitemSideDishDelete;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class MenuitemSideDishController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function store(MenuitemSideDishRequest $request)
    {
        try{
            /** @var MenuitemSideDishCreate $menuitemSideDishCreate */
            $menuitemSideDishCreate = $this->container->get(MenuitemSideDishCreate::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function delete(int $id)
    {
        try{
            /** @var MenuitemSideDishDelete $menuitemSideDishDelete */
            $menuitemSideDishDelete = $this->container->get(MenuitemSideDishDelete::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
