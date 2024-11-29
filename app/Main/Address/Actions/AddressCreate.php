<?php
namespace App\Main\Address\Actions;

use App\Main\Address\Repository\AddressRepositoryInterface;

class AddressCreate
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository
    ){}
}
