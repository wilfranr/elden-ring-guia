<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/locations',
        summary: "Obtiene la lista de ubicaciones",
        tags: ['ubicaciones'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de ubicaciones")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('locations');
    }

    #[OA\Get(
        path: '/api/locations/{id}',
        summary: "Obtiene una ubicación por ID",
        tags: ['ubicaciones'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la ubicación'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una ubicación por ID'),
           new OA\Response(response: 404, description: 'Ubicación no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('locations', $id);
    }
}
