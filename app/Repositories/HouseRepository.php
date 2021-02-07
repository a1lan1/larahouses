<?php

namespace App\Repositories;

use App\Contracts\HouseContract;
use App\Models\House;

class HouseRepository extends BaseRepository implements HouseContract
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model(): string
    {
        return House::class;
    }
}
