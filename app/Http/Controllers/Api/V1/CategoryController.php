<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Main\Category\Actions\CategoryCreate;
use App\Main\Category\Actions\CategoryList;
use App\Main\Category\Actions\CategoryUpdate;
use App\Traits\HttpResponse;
use Exception;
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
    public function listAllActives() : JsonResponse
    {
        try{
            /** @var CategoryList $categoryList */
            $categoryList = $this->container->get(CategoryList::class);
            $categories = $categoryList->listAllActives();
            $message = "List de toutes les categories actives";
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

    public function show(int $id) : JsonResponse
    {
        try{
            /** @var CategoryList $categoryList */
            $categoryList = $this->container->get(CategoryList::class);
            $data = $categoryList->findById($id);
            return response()
                ->json($this->successResponse("Info sur une categorie", $data));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}", 500));
        }
    }
    public function update(CategoryRequest $request) : JsonResponse
    {
        try{
            /** @var CategoryUpdate $categoryUpdate */
            $categoryUpdate = $this->container->get(CategoryUpdate::class);
            $category = $categoryUpdate->run($request);
            return response()
                ->json($this->successResponse("categorie actualisée avec succes", $category));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function updateImage(Request $request) : JsonResponse
    {
        try{
            /** @var CategoryUpdate $categoryUpdate */
            $categoryUpdate = $this->container->get(CategoryUpdate::class);
            $category = $categoryUpdate->updateImage($request);
            return response()
                ->json($this->successResponse("l'image actualisée avec succes", $category));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function updateIsActive($id) : JsonResponse
    {
        try{
            /** @var CategoryUpdate $categoryUpdate */
            $categoryUpdate = $this->container->get(CategoryUpdate::class);
            $category = $categoryUpdate->handleIsActive($id);
            return response()
                ->json($this->successResponse("status actualisé avec succés", $category));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
    public function getAllNotBelongsToCurrentRestaurant(int $restaurant_id)
    {
        try{
            /** @var CategoryList $categoryList */
            $categoryList = $this->container->get(CategoryList::class);
            $response = $categoryList->listAllNotBelongsToCurrentRestaurant($restaurant_id);
            return response()
                ->json($this->successResponse('list de tous les categories non crée', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
