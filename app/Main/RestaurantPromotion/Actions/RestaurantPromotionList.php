<?php
namespace App\Main\RestaurantPromotion\Actions;

use App\Main\RestaurantPromotion\Repository\RestaurantPromotionRepositoryInterface;

class RestaurantPromotionList
{
    public function __construct(
        private RestaurantPromotionRepositoryInterface $restaurantPromotionRepository
    ){}
}
