<?php
namespace App\Main\Category\Repository;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

interface CategoryRepositoryInterface
{
    public function create(FormRequest $request) : Category;
    public function listAll();
    public function find(int $id);
    public function findByName(string $name);
    public function update($request);
}
