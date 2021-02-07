<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\HouseService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\HousesListRequest;

class HouseController extends Controller
{
    /**
     * @var HouseService
     */
    private $houseService;

    /**
     * HouseController constructor.
     * @param HouseService $houseService
     */
    public function __construct(HouseService $houseService)
    {
        $this->houseService = $houseService;
    }

    /**
     * @param HousesListRequest $request
     * @return JsonResponse
     */
    public function list(HousesListRequest $request)
    {
        $houses = $this->houseService
            ->list($request->only([
                'name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages',
            ]));

        return response()->json($houses);
    }
}
