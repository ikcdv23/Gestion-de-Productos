<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Mostrar la lista de todas las categorías
     */
    public function index()
    {
        // Obtener todas las categorías de la base de datos
        $categories = Category::all();
        // Mostrar la vista index con las categorías
        return view('categories.index', compact('categories'));
    }

    /**
     * Mostrar el formulario para crear una nueva categoría
     */
    public function create()
    {
        // Mostrar la vista del formulario de creación
        return view('categories.create');
    }

    /**
     * Guardar una nueva categoría en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',        // El nombre es obligatorio
            'description' => 'required|string',         // La descripción es obligatoria
        ]);

        // Crear la nueva categoría con los datos del formulario
        Category::create($request->all());

        // Redirigir a la lista de categorías con mensaje de éxito
        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar los detalles de una categoría específica
     */
    public function show(Category $category)
    {
        // Mostrar la vista de detalles con la categoría
        return view('categories.show', compact('category'));
    }

    /**
     * Mostrar el formulario para editar una categoría
     */
    public function edit(Category $category)
    {
        // Mostrar la vista de edición con la categoría a editar
        return view('categories.edit', compact('category'));
    }

    /**
     * Actualizar una categoría en la base de datos
     */
    public function update(Request $request, Category $category)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'name' => 'required|string|max:255',        // El nombre es obligatorio
            'description' => 'required|string',         // La descripción es obligatoria
        ]);

        // Actualizar la categoría con los nuevos datos
        $category->update($request->all());

        // Redirigir a la lista de categorías con mensaje de éxito
        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar una categoría de la base de datos
     */
    public function destroy(Category $category)
    {
        // Eliminar la categoría (y sus productos por cascada)
        $category->delete();

        // Redirigir a la lista de categorías con mensaje de éxito
        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    public function dashboard()
    {
        // Usamos 'with' para cargar los productos y evitar consultas extra.
        // Esto trae todas las categorías y "pre-carga" sus productos asociados.
        $categories = Category::with('products')->orderBy('name')->get();

        return view('inventory.dashboard', compact('categories'));
    }
}