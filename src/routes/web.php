<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController; // <--- 1. ¡IMPORTANTE! Importar el nuevo controlador
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta raiz: Redirige al dashboard
Route::get('/', function () {
    return redirect()->route('inventory.dashboard'); 
});

// Ruta del Dashboard (Panel de Control)
Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('inventory.dashboard');

// Rutas para Categorías
Route::resource('categories', CategoryController::class);

// Rutas para Productos
Route::resource('products', ProductController::class);

// Rutas para Perfiles
// <--- 2. ¡NUEVO! Esto habilita la ruta 'profiles.show' que usas en el layout
Route::resource('profiles', ProfileController::class);

// Rutas de Recurso para Proveedores (CRUD completo)
Route::resource('suppliers', SupplierController::class); // ¡Nueva ruta!