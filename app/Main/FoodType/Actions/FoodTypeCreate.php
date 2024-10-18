<?php
namespace App\Main\FoodType\Actions;

use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
class FoodTypeCreate
{
    public function __construct(
        private FoodTypeRepositoryInterface $foodTypeRepository
    ){}

    public function run(FormRequest $request)
    {

    }
}