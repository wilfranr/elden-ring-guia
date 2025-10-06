<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ClassController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/classes',
        summary: "Obtiene la lista de clases",
        tags: ['clases'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de clases")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('classes');
    }

    #[OA\Get(
        path: '/api/classes/{id}',
        summary: "Obtiene una clase por ID",
        tags: ['clases'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la clase'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una clase por ID'),
           new OA\Response(response: 404, description: 'Clase no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('classes', $id);
    }
}
