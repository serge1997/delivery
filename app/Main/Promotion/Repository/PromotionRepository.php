<?php
namespace App\Main\Promotion\Repository;

use App\Main\Promotion\Exception\PromotionException;
use App\Models\Promotion;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Collection;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function create(array $data): Promotion
    {
        return Promotion::create($data);
    }
    public function listAll() : Collection
    {
        throw new PromotionException("Method not implemented");
    }
    public function find(int $id) : Promotion
    {
        return Promotion::find($id);
    }
    public function findByName(string $name) : Promotion
    {
        return Promotion::where("name", $name)->first();
    }
    public function inactivate(int $id) : Promotion
    {
        throw new PromotionException("Method not implemented");
    }
    public function update(array $data) : Promotion
    {
        throw new PromotionException("Method not implemented");
    }
    public function delete(int $id) : Promotion
    {
        throw new PromotionException("Method not implemented");
    }
}
