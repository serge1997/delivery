<?php
namespace App\Main\Neighbourhood\Actions;

use App\Http\Resources\UniqueNeighbourhoodResource;
use App\Http\Resources\NeighbourhoodResource;
use App\Main\City\Repository\CityRepositoryInterface;
use App\Main\Municipality\Repository\MunicipalityRepositoryInterface;
use App\Main\Neighbourhood\Exception\NeighbourhoodException;
use App\Main\Neighbourhood\Repository\NeighbourhoodRepositoryInterface;
use App\Models\Neighbourhood;
use Illuminate\Http\Resources\Json\JsonResource;

class NeighbourhoodList
{
    public function __construct(
        private NeighbourhoodRepositoryInterface $neighbourhoodRepository,
        private MunicipalityRepositoryInterface $municipalityRepository,
        private CityRepositoryInterface $cityRepository
    )
    {}

    public function listAll()
    {
        return NeighbourhoodResource::collection(
            $this->neighbourhoodRepository->listAll()
        );
    }

    public function listById(int $id)
    {
        $neighbourhood = $this->neighbourhoodRepository->find($id);
        if (!empty($neighbourhood)){
            return new UniqueNeighbourhoodResource($neighbourhood);
        }
        throw new NeighbourhoodException("l'identificateur introuvable");
    }

    public function listAllByMunicipality(int $municipality_id)
    {
        $municipality = $this->municipalityRepository->find($municipality_id);
        return NeighbourhoodResource::collection(
            $this->neighbourhoodRepository->findAllByMunicipality($municipality)
        );
    }

    public function listAllByCity(int $city_id)
    {
        $city = $this->cityRepository->find($city_id);
        return NeighbourhoodResource::collection(
            $this->neighbourhoodRepository->findAllByCity($city)
        );
    }
}
