<?php
namespace App\Main\FoodType\Repository;
use App\Models\FoodType;
use App\Service\Base\BaseRepository;

class FoodTypeRepository extends BaseRepository implements FoodTypeRepositoryInterface
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
    public function findAllNotBelongsToCurrentRestaurant(int $restaurant_id)
    {
        return FoodType::where('is_active', true)
            ->whereNotIn('id', function($query) use($restaurant_id){
                $query->select('food_type_id')
                    ->from('restaurants_food_types')
                        ->where('restaurant_id', $restaurant_id);
            })->get();
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
