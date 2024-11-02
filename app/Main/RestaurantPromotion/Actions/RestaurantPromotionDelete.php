<?php
namespace App\Main\RestaurantPromotion\Actions;

use App\Main\RestaurantPromotion\Repository\RestaurantPromotionRepositoryInterface;

class RestaurantPromotionDelete
{
    public function __construct(
        private RestaurantPromotionRepositoryInterface $restaurantPromotionRepository
    ){}
}
