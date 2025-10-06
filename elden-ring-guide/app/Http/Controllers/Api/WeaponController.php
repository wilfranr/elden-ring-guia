<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class WeaponController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/weapons',
        summary: "Obtiene la lista de armas",
        tags: ['armas'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de armas")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('weapons');
    }

    #[OA\Get(
        path: '/api/weapons/{id}',
        summary: "Obtiene un arma por ID",
        tags: ['armas'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del arma'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra un arma por ID'),
           new OA\Response(response: 404, description: 'Arma no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('weapons', $id);
    }
}
