<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class EldenRingApiService
{
    protected string $baseUrl = 'https://eldenring.fanapis.com/api/';

    /**
     * Obtiene una lista de recursos de Elden Ring desde la api.
     */
    public function getResources(string $resource): JsonResponse
    {
        $allData = [];
        $limit = 50;
        $page = 0;

        $firstResponse = Http::get($this->baseUrl . $resource, [
            'limit' => $limit,
            'page' => $page
        ]);

        if ($firstResponse->failed()) {
            return response()->json($firstResponse->json(), 500);
        }

        $firstData = $firstResponse->json();
        $totalResults = $firstData['total'] ?? 0;
        $allData = array_merge($allData, $firstData['data'] ?? []);

        $totalPages = ceil($totalResults / $limit);

        for ($page = 1; $page < $totalPages; $page++) {
            $response = Http::get($this->baseUrl . $resource, [
                'limit' => $limit,
                'page' => $page
            ]);

            if ($response->failed()) {
                continue;
            }

            $data = $response->json();
            $allData = array_merge($allData, $data['data'] ?? []);
        }

        return response()->json([
            'success' => true,
            'count' => count($allData),
            'data' => $allData
        ]);
    }


    /**
     * Obtiene un recurso específico de Elden Ring por su ID desde la api.
     */
    public function getResourceById(string $resource, string $id): JsonResponse
    {
        $response = Http::get($this->baseUrl . $resource . '/' . $id);

        if ($response->failed()) {
            return response()->json($response->json());
        }
        return response()->json($response->json());
    }

    // app/Services/EldenRingApiService.php
    public function getDataByRegion(string $regionName): JsonResponse
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get($this->baseUrl . 'locations', ['region' => $regionName, 'limit' => 100]),
            $pool->get($this->baseUrl . 'bosses', ['region' => $regionName, 'limit' => 100]),
        ]);

        if ($responses[0]->failed() || $responses[1]->failed()) {
            return response()->json(['message' => 'No se pudieron obtener los datos de la región'], 500);
        }

        $locationsInRegion = $responses[0]->json()['data'];
        $bossEncounters = $responses[1]->json()['data'];

        // --- LÓGICA DE AGRUPACIÓN ---
        $groupedBosses = [];
        foreach ($bossEncounters as $encounter) {
            $name = $encounter['name'];

            // Si es la primera vez que vemos este jefe, creamos su entrada principal
            if (!isset($groupedBosses[$name])) {
                $groupedBosses[$name] = [
                    'name' => $name,
                    'image' => $encounter['image'],
                    'description' => $encounter['description'],
                    'encounters' => [], // Un nuevo array para agrupar sus apariciones
                ];
            }

            // Añadimos los detalles de esta aparición específica (ubicación y drops)
            $groupedBosses[$name]['encounters'][] = [
                'location' => $encounter['location'],
                'drops' => $encounter['drops'],
            ];
        }

        return response()->json([
            'region' => $regionName,
            'locations' => $locationsInRegion,
            // Usamos array_values para devolver un array simple, no uno asociativo
            'bosses' => array_values($groupedBosses),
        ]);
    }
}
