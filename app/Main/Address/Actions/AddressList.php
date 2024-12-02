<?php
namespace App\Main\Address\Actions;

use App\Http\Resources\AddressResource;
use App\Main\Address\Repository\AddressRepositoryInterface;
use Illuminate\Http\Request;

class AddressList
{

    public function __construct(
        private AddressRepositoryInterface $addressRepository
    ){}


    public function listSearch(Request $request)
    {
        return AddressResource::collection(
            $this->addressRepository->search($request)
        );
    }
}
