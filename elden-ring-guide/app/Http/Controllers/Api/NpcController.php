<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class NpcController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/npcs',
        summary: "Obtiene la lista de NPCs",
        tags: ['npcs'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de NPCs")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('npcs');
    }

    #[OA\Get(
        path: '/api/npcs/{id}',
        summary: "Obtiene un NPC por ID",
        tags: ['npcs'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del NPC'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un NPC por ID'),
           new OA\Response(response: 404, description: 'NPC no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('npcs', $id);
    }
}
