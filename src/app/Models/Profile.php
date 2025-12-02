<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory; // 2. ¡Usar el Trait dentro de la clase!

    // Asumo que tu base de datos usa 'rol', no 'role'. Si usas 'role', cámbialo aquí.
    protected $fillable = ['name', 'email'];

    public function user()
    {
        // belongsTo(Modelo, 'clave_foranea_en_esta_tabla', 'clave_duena_en_otra_tabla')
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
