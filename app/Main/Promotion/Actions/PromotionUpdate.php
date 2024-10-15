<?php
namespace App\Main\Promotion\Actions;

use App\Http\Resources\PromotionResource;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;

class PromotionUpdate
{
    public function __construct(
        private PromotionRepositoryInterface $promotionRepository
    )
    {

    }
    public function handleUpdateIsActive(int $id)
    {
        $promotion = $this->promotionRepository->find($id);
        return new PromotionResource(
            $this->promotionRepository->handleUpdateIsActive($promotion)
        );
    }
}
