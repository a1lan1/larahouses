<?php

namespace App\Services;

use App\Contracts\HouseContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HouseService
{
    const PER_PAGE = 10;

    /**
     * @var HouseContract
     */
    private $houseRepo;

    /**
     * HouseService constructor.
     * @param HouseContract $houseRepo
     */
    public function __construct(HouseContract $houseRepo)
    {
        $this->houseRepo = $houseRepo;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function list(array $request): LengthAwarePaginator
    {
        $prices = explode('-', $request['price']);

        return $this->houseRepo
            ->where('price', $prices[0], '>=')
            ->where('price', $prices[1], '<=')
            ->when($request['name'] !== 'null', function ($q) use ($request) {
                return $q->where('name', "%{$request['name']}%", 'LIKE');
            })
            ->when($request['bedrooms'] !== 'null', function ($q) use ($request) {
                return $q->where('bedrooms', $request['bedrooms']);
            })
            ->when($request['bathrooms'] !== 'null', function ($q) use ($request) {
                return $q->where('bathrooms', $request['bathrooms']);
            })
            ->when($request['storeys'] !== 'null', function ($q) use ($request) {
                return $q->where('storeys', $request['storeys']);
            })
            ->when($request['garages'] !== 'null', function ($q) use ($request) {
                return $q->where('garages', $request['garages']);
            })
            ->paginate(self::PER_PAGE);
    }
}
