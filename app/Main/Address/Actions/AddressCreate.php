<?php
namespace App\Main\Address\Actions;

use App\Http\Resources\AddressResource;
use App\Main\Address\Exception\AddressException;
use App\Main\Address\Repository\AddressRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class AddressCreate
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository
    ){}

    public function run(FormRequest $request)
    {
        if ($request->has_municipality){
            $address_finded = $this->addressRepository->findByCityAndMunicipalityAndNeighbourdhood($request);
            if($address_finded){
                throw new AddressException("l'address existe déja dans le systeme");
            }

            return new AddressResource(
                $this->addressRepository->create($request)
            );
        }else{
            $address_finded = $this->addressRepository->findByCityAndNeighbourhood($request);
            if($address_finded){
                throw new AddressException("l'address existe déja dans le systeme");
            }
            return new AddressResource(
                $this->addressRepository->create($request)
            );
        }
    }
}
