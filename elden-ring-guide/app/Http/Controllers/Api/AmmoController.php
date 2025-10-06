<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EldenRingApiService;
use OpenApi\Attributes as OA;
use Illuminate\Http\JsonResponse;

class AmmoController extends Controller
{
    public function __construct(protected EldenRingApiService $eldenRingApi)
    {
    }

    #[OA\Get(
        path: '/api/ammos',
        summary: "Obtiene la lista de municiones",
        tags: ['municiones'],
        responses: [new OA\Response(response: 200, description: "Muestra la lista de municiones")],
    )]
    public function index(): JsonResponse
    {
        return $this->eldenRingApi->getResources('ammos');
    }

    #[OA\Get(
        path: '/api/ammos/{id}',
        summary: "Obtiene una munición por ID",
        tags: ['municiones'],
        parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID de la munición'
           )
        ],
        responses: [
           new OA\Response(response: 200, description: 'Muestra una munición por ID'),
           new OA\Response(response: 404, description: 'Munición no encontrada')
        ],
    )]
    public function show(string $id): JsonResponse
    {
        return $this->eldenRingApi->getResourceById('ammos', $id);
    }
}
