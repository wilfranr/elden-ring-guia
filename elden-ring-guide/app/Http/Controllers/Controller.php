<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Elden Ring API Documentation',
    description: 'Documentación de la API para la guia de Elden Ring'
)]
#[OA\Get(
    path: '/api/ping',
    description: 'A sample endpoint to test the API and ensure documentation generation works.',
    tags: ['Health Check'],
    responses: [
        new OA\Response(response: 200, description: 'Successful operation')
    ]
)]
abstract class Controller
{
    //
}
