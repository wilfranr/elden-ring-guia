<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class TalismanController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/talismans',
        summary: "Obtiene la lista de talismanes",
        tags: ['talismanes'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de talismanes")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('talismans');
    }

    #[OA\Get(
        path: '/api/talismans/{id}',
        summary: "Obtiene un talismán por ID",
        tags: ['talismanes'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del talismán'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un talismán por ID'),
           new OA\Response(response: 404, description: 'Talismán no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('talismans', $id);
    }
}
