<?php
namespace App\Main\Promotion\Actions;

use App\Main\Promotion\Repository\PromotionRepositoryInterface;

class PromotionList
{
    public function __construct(
        private PromotionRepositoryInterface $promotionRepository
    ){}

    public function listAll()
    {

    }
}
