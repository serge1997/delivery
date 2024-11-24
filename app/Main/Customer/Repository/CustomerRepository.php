<?php
namespace App\Main\Customer\Repository;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
class CustomerRepository implements CustomerRepositoryInterface
{

    public function create($request)
    {
        return Customer::create($request->validated());
    }
    public function find(int $id) : Customer
    {
        return Customer::find($id);
    }
    public function findByPhone(string $phone) : ?Customer
    {
        return Customer::where('phone', $phone)->first();
    }
    public function findByEmail(string $email) : ?Customer
    {
        return Customer::where('email', $email)->first();
    }
    public function findByName(string $name) : ?Customer
    {
        return Customer::where('name', $name)->first();
    }
    public function searchByName(string $name) : Collection
    {
        return Customer::whereRaw("name LIKE '%{$name}%'")->get();
    }
}
