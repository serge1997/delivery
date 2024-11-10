<?php
namespace App\Main\SideDish\Actions;

use App\Http\Resources\SideDishResource;
use App\Main\SideDish\Repository\SideDishRepositoryInterface;

class SideDishList
{
    public function __construct(
        private SideDishRepositoryInterface $sideDishRepository
    )
    {}

    public function listAllByAuthRestaurant(int $auth)
    {
        return SideDishResource::collection(
            $this->sideDishRepository->findAllByAuthRestaurant($auth)
        );
    }
}
