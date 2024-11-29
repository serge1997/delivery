<?php
namespace App\Main\Municipality\Actions;

use App\Http\Resources\MunicipalityResource;
use App\Main\City\Repository\CityRepositoryInterface;
use App\Main\Municipality\Repository\MunicipalityRepositoryInterface;
use App\Main\Municipality\Exception\MunicipalityException;

class MunicipalityList
{
    public function __construct(
        private MunicipalityRepositoryInterface $municipalityRepository,
        private CityRepositoryInterface $cityRepository
    )
    {}

    public function listAll()
    {
        return MunicipalityResource::collection(
            $this->municipalityRepository->listAll()
        );
    }

    public function listById(int $id)
    {
        $municpality = $this->municipalityRepository->find($id);
        if (!empty($municpality)){
            return new MunicipalityResource(
                $municpality
            );
        }
        throw new MunicipalityException("l'identificateur de la commune introuvable");
    }

    public function listAllByCity(int $city_id)
    {
        $city = $this->cityRepository->find($city_id);
        return MunicipalityResource::collection(
            $this->municipalityRepository->findAllByCity($city)
        );
    }
}
