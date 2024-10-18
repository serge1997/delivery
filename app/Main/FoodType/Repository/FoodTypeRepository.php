<?php
namespace App\Main\FoodType\Repository;
use App\Models\FoodType;
class FoodTypeRepository implements FoodTypeRepositoryInterface
{

    public function create(array $data): FoodType
    {
        return FoodType::create($data);
    }

    public function find(int $id): FoodType
    {
        return FoodType::find($id);
    }

    public function findByName(string $name): ?FoodType
    {
        return FoodType::where('name', $name)->first();
    }

    public function listAll()
    {
        return FoodType::all();
    }
    public function listAllActives()
    {
        return FoodType::where('is_active', true)->get();
    }
    public function update($request): FoodType
    {
        $foodType = $this->find($request->id());
        $foodType->update([
            'name'=> $request->name(),
            'description' => $request->description(),
            'is_active' => $request->isActive()

        ]);
        return $foodType;
    }

    public function handleIsActive(FoodType $foodType): FoodType
    {
        $foodType->update([
            'is_active' => !$foodType->is_active
        ]);
        return $foodType;
    }
}