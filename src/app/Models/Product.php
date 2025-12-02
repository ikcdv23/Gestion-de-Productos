<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Especificar el nombre de la tabla en la base de datos
    protected $table = 'products';

    // Campos que pueden ser llenados masivamente (mass assignment)
    protected $fillable = ['name', 'price', 'stock', 'category_id', 'supplier_id',];

    // Un Producto NO pertenece a un SOLO Proveedor --> N:M | CORRECIÓN
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    /**
     * categoria 1:N Productos
     * MUCHOS producto perteneceN a una categoría
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}