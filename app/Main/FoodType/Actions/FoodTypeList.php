<?php
namespace App\Main\FoodType\Actions;

use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;

class FoodTypeList
{
    public function __construct(
        private FoodTypeRepositoryInterface $foodTypeRepository
    ){}
}