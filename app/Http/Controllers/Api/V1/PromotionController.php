<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Main\Promotion\Actions\PromotionCreate;
use App\Main\Promotion\Actions\PromotionList;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Psr\Container\ContainerInterface;

class PromotionController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    )
    {}

    public function onCreate(PromotionRequest $request): JsonResponse
    {
        try{
            $message = "Promotion creé avec succés";
            /** @var PromotionCreate $promotionCreate */
            $promotionCreate = $this->container->get(PromotionCreate::class);
            $data = $promotionCreate->run($request);
            return response()
                ->json($this->successResponse($message, $data));

        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function index(): JsonResponse
    {
        try{
            $message = "List de toutes les promotions";
            /** @var PromotionList $promotionList */
            $promotionList = $this->container->get(PromotionList::class);
            $data = $promotionList->listAll();
            return response()
                ->json($this->successResponse($message, $data));

        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try{
            $message = "List de toutes les promotions";
            /** @var PromotionList $promotionList */
            $promotionList = $this->container->get(PromotionList::class);
            $data = $promotionList->find($id);
            return response()
                ->json($this->successResponse($message, $data));
        }catch(\Exception $e){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}", 500));
        }
    }
}
