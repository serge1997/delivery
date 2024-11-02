<?php
namespace App\Main\RestaurantPromotion\Actions;

use App\Main\RestaurantPromotion\Repository\RestaurantPromotionRepositoryInterface;

class RestaurantPromotionCreate
{
    public function __construct(
        private RestaurantPromotionRepositoryInterface $restaurantPromotionRepository
    )
    {}
}
