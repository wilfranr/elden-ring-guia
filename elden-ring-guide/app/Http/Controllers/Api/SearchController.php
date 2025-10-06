<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SearchableItem;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Obtiene el término de búsqueda de la URL (ej. /api/search?q=malenia)
        $query = $request->query('q');

        if (empty($query)) {
            return response()->json(['data' => []]);
        }

        // Usa Scout para buscar en Meilisearch
        $results = SearchableItem::search($query)->get();

        return response()->json($results);
    }
}
