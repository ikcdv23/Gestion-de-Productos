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
        Schema::table('products', function (Blueprint $table) {
            // Añadir la clave foránea (permitimos que sea NULL temporalmente si hay productos existentes)
            $table->foreignId('supplier_id')
                ->nullable() // Asumimos que al inicio el proveedor puede ser opcional.
                ->constrained('suppliers')
                ->onDelete('set null') // Si el proveedor se borra, el producto queda sin proveedor (null)
                ->after('category_id'); // Posicionamos después de la categoría
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hay que eliminar primero la foreign key constraint antes de la columna
            $table->dropConstrainedForeignId('supplier_id');
            $table->dropColumn('supplier_id');
        });
    }
};
