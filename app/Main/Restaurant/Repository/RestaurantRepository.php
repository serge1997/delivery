<?php
namespace App\Main\Restaurant\Repository;

use App\Models\Restaurant;
use App\Service\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class RestaurantRepository extends BaseRepository implements RestaurantRepositoryInterface
{
    public function create(array $data)
    {
        return Restaurant::create($data);
    }

    public function findAllActives() : Collection
    {
        return Restaurant::where('is_active', true)->get();
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

    public function updateImages($request)
    {
        $this->uploadImages($request, 'cover_image', 'images/restaurants-covers');
        $this->uploadImages($request, 'logo', 'images/restaurants-logos');
    }
}
