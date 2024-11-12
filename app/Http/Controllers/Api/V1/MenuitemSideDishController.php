<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuitemSideDishRequest;
use App\Main\MenuitemSideDish\Actions\MenuitemSideDishCreate;
use App\Main\MenuitemSideDish\Actions\MenuitemSideDishDelete;
use App\Main\MenuitemSideDish\Actions\MenuitemSideDishList;
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

    public function getAllByMenuitem(int $menuitem_id)
    {
        try{
            /** @var MenuitemSideDishList $menuitemSideDishList */
            $menuitemSideDishList = $this->container->get(MenuitemSideDishList::class);
            $data = $menuitemSideDishList->listAllByMenuitem($menuitem_id);
            return response()
                ->json($this->successResponse('list des accompagnement par type de menu', $data));

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
            $response = $menuitemSideDishDelete->run($id);
            return response()
                ->json($this->successResponse("l'accompagnement supprimé avec succes", $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
