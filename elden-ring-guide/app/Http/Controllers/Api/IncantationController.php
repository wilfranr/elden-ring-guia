<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class IncantationController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/incantations',
        summary: "Obtiene la lista de encantamientos",
        tags: ['encantamientos'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de encantamientos")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('incantations');
    }

    #[OA\Get(
        path: '/api/incantations/{id}',
        summary: "Obtiene un encantamiento por ID",
        tags: ['encantamientos'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del encantamiento'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un encantamiento por ID'),
           new OA\Response(response: 404, description: 'Encantamiento no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('incantations', $id);
    }
}
