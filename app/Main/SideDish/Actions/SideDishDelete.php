<?php
namespace App\Main\SideDish\Actions;

use App\Main\SideDish\Repository\SideDishRepositoryInterface;

class SideDishDelete
{
    public function __construct(
        private SideDishRepositoryInterface $sideDishRepository
    )
    {

    }
}
