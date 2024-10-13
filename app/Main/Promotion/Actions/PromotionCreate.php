<?php
namespace App\Main\Promotion\Actions;

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

    }
}
