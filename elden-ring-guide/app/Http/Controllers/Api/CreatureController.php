<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class CreatureController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/creatures',
        summary: "Obtiene la lista de criaturas",
        tags: ['criaturas'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de criaturas")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('creatures');
    }

    #[OA\Get(
        path: '/api/creatures/{id}',
        summary: "Obtiene una criatura por ID",
        tags: ['criaturas'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la criatura'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una criatura por ID'),
           new OA\Response(response: 404, description: 'Criatura no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('creatures', $id);
    }
}
