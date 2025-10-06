<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class ShieldController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/shields',
        summary: "Obtiene la lista de escudos",
        tags: ['escudos'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de escudos")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('shields');
    }

    #[OA\Get(
        path: '/api/shields/{id}',
        summary: "Obtiene un escudo por ID",
        tags: ['escudos'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del escudo'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un escudo por ID'),
           new OA\Response(response: 404, description: 'Escudo no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('shields', $id);
    }
}
