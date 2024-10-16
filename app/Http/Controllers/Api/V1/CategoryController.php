<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Main\Category\Actions\CategoryCreate;
use App\Main\Category\Actions\CategoryList;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class CategoryController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function index() : JsonResponse
    {
        try{
            /** @var CategoryList $categoryList */
            $categoryList = $this->container->get(CategoryList::class);
            $categories = $categoryList->listAll();
            $message = "List de toutes les categories";
            return response()
                ->json($this->successResponse($message, $categories));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}", 500));
        }
    }

    public function store(CategoryRequest $request) : JsonResponse
    {
        try{
            $request->validated();
            /** @var CategoryCreate $categoryCreate */
            $categoryCreate = $this->container->get(CategoryCreate::class);
            $category = $categoryCreate->run($request);
            $message = "Categorie enregistré avec succes";
            return response()
                ->json($this->successResponse($message, $category));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show() : JsonResponse
    {
        try{
            /** @var CategoryList $categoryList */
            $categoryList = $this->container->get(CategoryList::class);
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}", 500));
        }
    }
}
