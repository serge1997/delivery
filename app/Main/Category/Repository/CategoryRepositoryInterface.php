<?php
namespace App\Main\Category\Repository;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function create(array $data) : Category;
    public function listAll();
    public function find(int $id);
    public function findByName(string $name);
    public function update($request);
}
