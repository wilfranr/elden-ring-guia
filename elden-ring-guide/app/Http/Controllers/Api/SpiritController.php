<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class SpiritController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/spirits',
        summary: "Obtiene la lista de espíritus",
        tags: ['espíritus'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de espíritus")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('spirits');
    }

    #[OA\Get(
        path: '/api/spirits/{id}',
        summary: "Obtiene un espíritu por ID",
        tags: ['espíritus'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del espíritu'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un espíritu por ID'),
           new OA\Response(response: 404, description: 'Espíritu no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('spirits', $id);
    }
}
