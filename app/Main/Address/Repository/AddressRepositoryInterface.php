<?php
namespace App\Main\Address\Repository;

interface AddressRepositoryInterface
{

    public function create($request);
    public function search($request);
    public function findByCityAndMunicipalityAndNeighbourdhood($request);
    public function findByCityAndNeighbourhood($request);
}
