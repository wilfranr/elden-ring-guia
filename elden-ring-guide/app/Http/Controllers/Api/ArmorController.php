<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class ArmorController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/armors',
        summary: "Obtiene la lista de armaduras",
        tags: ['armaduras'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de armaduras")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('armors');
    }

    #[OA\Get(
        path: '/api/armors/{id}',
        summary: "Obtiene una armadura por ID",
        tags: ['armaduras'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la armadura'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una armadura por ID'),
           new OA\Response(response: 404, description: 'Armadura no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('armors', $id);
    }
}
