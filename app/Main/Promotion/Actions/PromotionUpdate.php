<?php
namespace App\Main\Promotion\Actions;

use App\Http\Resources\PromotionResource;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class PromotionUpdate
{
    public function __construct(
        private PromotionRepositoryInterface $promotionRepository
    )
    {}
    public function run(FormRequest $request)
    {
        return new PromotionResource(
            $this->promotionRepository->update($request)
        );

    }
    public function handleUpdateIsActive(int $id)
    {
        $promotion = $this->promotionRepository->find($id);
        return new PromotionResource(
            $this->promotionRepository->handleUpdateIsActive($promotion)
        );
    }
}
