<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class AshController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/ashes',
        summary: "Obtiene la lista de cenizas",
        tags: ['cenizas'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de cenizas")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('ashes');
    }

    #[OA\Get(
        path: '/api/ashes/{id}',
        summary: "Obtiene una ceniza por ID",
        tags: ['cenizas'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la ceniza'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una ceniza por ID'),
           new OA\Response(response: 404, description: 'Ceniza no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('ashes', $id);
    }
}
