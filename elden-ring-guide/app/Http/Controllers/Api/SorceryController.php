<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class SorceryController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/sorceries',
        summary: "Obtiene la lista de hechizos",
        tags: ['hechizos'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de hechizos")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('sorceries');
    }

    #[OA\Get(
        path: '/api/sorceries/{id}',
        summary: "Obtiene un hechizo por ID",
        tags: ['hechizos'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del hechizo'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un hechizo por ID'),
           new OA\Response(response: 404, description: 'Hechizo no encontrado')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('sorceries', $id);
    }
}
