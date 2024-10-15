<?php
namespace App\Main\Promotion\Actions;

use App\Http\Resources\PromotionResource;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;

class PromotionList
{
    public function __construct(
        private PromotionRepositoryInterface $promotionRepository
    ){}

    public function listAll()
    {
        return PromotionResource::collection(
            $this->promotionRepository->listAll()
        );
    }

    public function find(int $id)
    {
        return new PromotionResource(
            $this->promotionRepository->find($id)
        );
    }
}
