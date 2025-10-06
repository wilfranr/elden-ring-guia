<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EldenRingApiService;
use App\Models\SearchableItem;
use Illuminate\Support\Facades\Http;

class SyncGameData extends Command
{
    /**
     * El nombre y la firma del comando de consola.
     */
    protected $signature = 'app:sync-game-data';

    /**
     * La descripción del comando de consola.
     */
    protected $description = 'Sincroniza los datos de la API de Elden Ring con la base de datos local.';

    /**
     * Ejecuta el comando de consola.
     */
    public function handle(EldenRingApiService $apiService)
    {
        $this->info('Iniciando la sincronización de datos de Elden Ring...');

        // Definimos todos los tipos de recursos que queremos sincronizar
        $resources = [
            'bosses', 'items', 'locations', 'weapons', 'armors',
            'shields', 'talismans', 'spirits', 'sorceries', 'incantations',
            'ashes', 'creatures', 'npcs', 'classes', 'ammos',
        ];

        foreach ($resources as $resource) {
            $this->line("Obteniendo datos de: {$resource}...");

            // Usamos una llamada directa a la API aquí para obtener todos los datos
            // La lógica de paginación es necesaria como en el servicio.
            $allData = $this->fetchAllPaginated($resource);

            if (empty($allData)) {
                $this->warn("No se encontraron datos o hubo un error para: {$resource}");
                continue;
            }

            // Usamos una barra de progreso para una mejor experiencia visual
            $progressBar = $this->output->createProgressBar(count($allData));
            $progressBar->start();

            foreach ($allData as $item) {
                // Usamos updateOrCreate para insertar o actualizar, evitando duplicados
                SearchableItem::updateOrCreate(
                    ['name' => $item['name'], 'type' => $resource],
                    [
                        'description' => $item['description'] ?? null,
                        'image' => $item['image'] ?? null,
                        'region' => $item['region'] ?? null,
                        'extra_data' => $item, // Guardamos el objeto original completo en el campo JSON
                    ]
                );
                $progressBar->advance();
            }
            $progressBar->finish();
            $this->newLine(2);
        }

        $this->info('¡Sincronización completada exitosamente!');
        return 0;
    }

    /**
     * Un método privado para manejar la paginación para todos los recursos.
     */
    private function fetchAllPaginated(string $resource): array
    {
        $allData = [];
        $limit = 100; // Pedimos de 100 en 100 para ser más rápidos
        $page = 0;

        while (true) {
            $response = Http::get("https://eldenring.fanapis.com/api/{$resource}", [
                'limit' => $limit,
                'page' => $page
            ]);

            if ($response->failed()) {
                break;
            }

            $data = $response->json()['data'];

            if (empty($data)) {
                break;
            }

            $allData = array_merge($allData, $data);
            $page++;
        }

        return $allData;
    }
}
