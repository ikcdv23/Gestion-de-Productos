<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // 1. Clave Foránea: Usamos 'category_id'
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            // 2. Columna 'name'
            $table->string('name', 255);

            // 3. Columna 'price'
            $table->decimal('price', 8, 2);

            // 4. Columna 'stock_quantity'
            $table->unsignedInteger('stock');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
