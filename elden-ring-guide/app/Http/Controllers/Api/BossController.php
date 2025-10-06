<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class BossController extends Controller
{
    // Inyectar el servicio en el constructor
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/bosses',
        tags: ['jefes'],
        summary: "Obtiene la lista de jefes",
        responses: [new OA\Response(response: 200, description: "Muestra la lista de jefes")],
    )]


    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('bosses');
    }

    #[OA\Get(
        path: '/api/bosses/{id}',
        summary: "Obtiene un jefe por ID",
        tags: ['jefes'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del jefe'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un jefe por ID'),
           new OA\Response(response: 404, description: 'Jefe no encontrado')
        ]
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('bosses', $id);
    }
}
