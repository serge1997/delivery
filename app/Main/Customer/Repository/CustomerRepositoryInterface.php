<?php
namespace App\Main\Customer\Repository;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    public function create($request);
    public function find(int $id) : Customer;
    public function findByPhone(string $phone) : ?Customer;
    public function findByEmail(string $email) : ?Customer;
    public function findByName(string $name) : ?Customer;
    public function searchByName(string $name) : Collection;
}
