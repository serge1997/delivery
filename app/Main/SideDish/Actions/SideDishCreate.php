<?php
namespace App\Main\SideDish\Actions;

use App\Main\SideDish\Repository\SideDishRepositoryInterface;

class SideDishCreate
{
    public function __construct(
        private SideDishRepositoryInterface $sideDishRepository
    )
    {

    }
}
