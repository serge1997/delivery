<?php
namespace App\Main\FoodType\Actions;

use App\Http\Resources\FoodTypeResource;
use App\Main\FoodType\Repository\FoodTypeRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class FoodTypeUpdate
{
    public function __construct(
        private FoodTypeRepositoryInterface $foodTypeRepository
    ){}

    public function run(FormRequest $request)
    {
        return new FoodTypeResource(
            $this->foodTypeRepository->update($request)
        );
    }
    public function handleIsActive(int $id)
    {
        $foodType = $this->foodTypeRepository->find($id);
        return new FoodTypeResource(
            $this->foodTypeRepository->handleIsActive($foodType)
        );
    }
}