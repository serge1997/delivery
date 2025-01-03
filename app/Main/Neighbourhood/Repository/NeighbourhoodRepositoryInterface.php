<?php
namespace App\Main\Neighbourhood\Repository;

use App\Models\City;
use App\Models\Municipality;
use App\Models\Neighbourhood;

interface NeighbourhoodRepositoryInterface
{
    public function create(array $requests) : Neighbourhood;
    public function findOrCreate($request, Municipality $municipality);
    public function listAll();
    public function findByName(string $name) : ?Neighbourhood;
    public function findByNameAndMunicipality(string $name, int $municipality) : ?Neighbourhood;
    public function findAllByMunicipality(Municipality $municipality);
    public function find(int $id) : ?Neighbourhood;
    public function findAllByCity(City $city);
}
