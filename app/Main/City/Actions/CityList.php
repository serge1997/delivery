<?php
namespace App\Main\City\Actions;

use App\Http\Resources\CityResource;
use App\Main\City\Repository\CityRepositoryInterface;

class CityList
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ){}

    public function listAll()
    {
        return CityResource::collection(
            $this->cityRepository->listAll()
        );
    }
    public function listById(int $id)
    {
        return new CityResource(
            $this->cityRepository->find($id)
        );
    }
}
