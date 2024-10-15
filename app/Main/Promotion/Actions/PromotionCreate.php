<?php
namespace App\Main\Promotion\Actions;

use App\Http\Resources\PromotionResource;
use App\Main\Promotion\Exception\PromotionException;
use App\Main\Promotion\Repository\PromotionRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class PromotionCreate
{
    public function __construct(
        private PromotionRepositoryInterface $promotionRepository
    )
    {

    }
    public function run(FormRequest $request)
    {
        $promotion = $this->promotionRepository->findByName($request->name());
        if (!$promotion) {
            return new PromotionResource(
                $this->promotionRepository->create($request->validated())
            );
        }
        throw new PromotionException("La promotion {$request->name()} exist déja");
    }
}
