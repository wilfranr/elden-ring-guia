<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ItemController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/items',
        summary: "Obtiene la lista de ítems",
        tags: ['ítems'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de ítems")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('items');
    }

    #[OA\Get(
        path: '/api/items/{id}',
        summary: "Obtiene un ítem por ID",
        tags: ['ítems'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del ítem'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un ítem por ID'),
           new OA\Response(response: 404, description: 'Ítem no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('items', $id);
    }
}
