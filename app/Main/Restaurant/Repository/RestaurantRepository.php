<?php
namespace App\Main\Restaurant\Repository;

use App\Models\Restaurant;
use App\Service\Base\BaseRepository;

class RestaurantRepository extends BaseRepository implements RestaurantRepositoryInterface
{
    public function create(array $data)
    {
        return Restaurant::create($data);
    }

    public function findByNameAndPhone(string $name, string $phone) : ?Restaurant
    {
        return Restaurant::where("name", $name)
            ->orWhere('phone', $phone)
                ->first();
    }
    public function find(int $id) : Restaurant
    {
        return Restaurant::find($id);
    }
}
