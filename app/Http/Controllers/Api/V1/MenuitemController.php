<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuitemRequest;
use App\Main\Menuitem\Actions\MenuitemCreate;
use App\Traits\HttpResponse;
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
}
