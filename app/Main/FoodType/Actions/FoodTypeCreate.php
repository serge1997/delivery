<?php
namespace App\Main\FoodType\Actions;

use App\Http\Resources\FoodTypeResource;
use App\Main\FoodType\Exception\FoodTypeException;
use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
class FoodTypeCreate
{
    public function __construct(
        private FoodTypeRepositoryInterface $foodTypeRepository
    ){}

    public function run(FormRequest $request)
    {
        $foodType = $this->foodTypeRepository->findByName($request->name());
        if (!$foodType) {
            return new FoodTypeResource(
                $this->foodTypeRepository->create($request->validated())
            );
        }
        throw new FoodTypeException("Le type de plat exist déja");
       
    }
}