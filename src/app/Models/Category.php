<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Especificar el nombre de la tabla en la base de datos
    protected $table = 'categories';
    
    // Campos que pueden ser llenados masivamente (mass assignment)
    protected $fillable = ['name', 'description'];
    
    /**
     * Relación uno a muchos con el modelo Product
     * Una categoría puede tener muchos productos
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}