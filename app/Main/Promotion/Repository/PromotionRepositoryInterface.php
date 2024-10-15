<?php
namespace App\Main\Promotion\Repository;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;

interface PromotionRepositoryInterface
{
    public function create(array $data): Promotion;
    public function listAll() : Collection;
    public function find(int $id) : Promotion;
    public function findByName(string $name) : ?Promotion;
    public function inactivate(int $id) : Promotion;
    public function update(array $data) : Promotion;
    public function delete(int $id) : Promotion;
}
