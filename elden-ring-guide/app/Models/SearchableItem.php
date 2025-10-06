<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SearchableItem extends Model
{
    use HasFactory;
    use Searchable; // 2. Usa el trait

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // 3. Define los campos "llenables"
        'name',
        'type',
        'description',
        'image',
        'region',
        'extra_data',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'extra_data' => 'array', // 4. Laravel tratará este campo como un array/JSON
    ];
}
