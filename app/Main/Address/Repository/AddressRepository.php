<?php
namespace App\Main\Address\Repository;

use App\Models\Address;
use App\Service\Base\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{

    public function create($request)
    {
        return Address::create($request->validated());
    }
    public function search($request)
    {
        return Address::whereRaw("street_reference like '%{$request->street_reference}%'")
            ->get();
    }

    public function findByCityAndMunicipalityAndNeighbourdhood($request)
    {
        return Address::where([
                ['city_id', $request->city_id],
                ['municipality_id', $request->municipality_id],
                ['neighbourhood_id', $request->neighbourhood_id],
                ['street_reference', explode('-', $request->street_reference)[0]]
            ])->first();
    }

    public function findByCityAndNeighbourhood($request)
    {
        return Address::where([
            ['city_id', $request->city_id],
            ['neighbourhood_id', $request->neighbourhood_id],
            ['street_reference', $request->street_reference]
        ])->first();
    }
}
