<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    public function show(string $region): JsonResponse
    {
        return $this->eldenRingApi->getDataByRegion($region);
    }
}
