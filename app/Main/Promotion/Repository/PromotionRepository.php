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
        return Promotion::all();
    }
    public function listAllActives() : Collection
    {
        return Promotion::where('is_active', true)->get();
    }
    public function find(int $id) : Promotion
    {
        return Promotion::find($id);
    }
    public function findByName(string $name) : ?Promotion
    {
        return Promotion::where("name", $name)->first();
    }
    public function handleUpdateIsActive(Promotion $promotion) : Promotion
    {
        $promotion->update([
            "is_active"=> !$promotion->is_active
        ]);
        return $promotion;
    }
    public function update($request) : Promotion
    {
        $promotion = $this->find($request->id());
        $promotion->update([
            "name"=> $request->name(),
            "description" => $request->description()
        ]);
        return $promotion;
    }
    public function delete(int $id) : Promotion
    {
        throw new PromotionException("Method not implemented");
    }
}
