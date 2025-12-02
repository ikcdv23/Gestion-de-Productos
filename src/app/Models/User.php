<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. ¡Importar el Trait!
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory; // 2. ¡Usar el Trait dentro de la clase!
    
    // Asumo que tu base de datos usa 'rol', no 'role'. Si usas 'role', cámbialo aquí.
    protected $fillable = [
        "name",
        "email",
        "rol", 
        "password",
    ];
    
    // Si tu tabla no se llama 'users', añade esto:
    // protected $table = 'users'; 

    public function profile()
    {
        // hasOne(Modelo, 'clave_foranea_en_otra_tabla', 'clave_local_en_esta_tabla')
        return $this->hasOne(Profile::class, 'email', 'email');
    }
}