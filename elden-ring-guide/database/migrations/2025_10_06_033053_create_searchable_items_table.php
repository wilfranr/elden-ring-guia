<?php

// database/migrations/..._create_searchable_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('searchable_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index(); // Indexamos el nombre para búsquedas rápidas
            $table->string('type'); // 'boss', 'item', 'location', etc.
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('region')->nullable();
            $table->json('extra_data')->nullable(); // Un campo JSON para datos adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('searchable_items');
    }
};
