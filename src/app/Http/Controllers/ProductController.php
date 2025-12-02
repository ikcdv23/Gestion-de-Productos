<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mostrar la lista de todos los productos
     */
    public function index()
    {
        // Obtener todos los productos con sus categorías relacionadas
        $products = Product::with('category')->get();
        // Mostrar la vista index con los productos
        return view('products.index', compact('products'));
    }

    /**
     * Mostrar el formulario para crear un nuevo producto
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all(); // <--- 2. Obtenemos los proveedores
        
        // Enviamos ambas variables a la vista
        return view('products.create', compact('categories', 'suppliers'));
    }

    /**
     * Guardar un nuevo producto en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id', // <--- 3. Validamos el proveedor
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Mostrar los detalles de un producto específico
     */
    public function show(Product $product)
    {
        // Mostrar la vista de detalles con el producto
        return view('products.show', compact('product'));
    }

    /**
     * Mostrar el formulario para editar un producto
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all(); // <--- 4. Obtenemos proveedores para editar
        
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Actualizar un producto en la base de datos
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id', // <--- 5. Validamos en update
        ]);

        $product->update($request->all());

        return redirect()->route('products.index') // O al dashboard
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto de la base de datos
     */
    public function destroy(Product $product)
    {
        // Eliminar el producto
        $product->delete();

        // Redirigir a la lista de productos con mensaje de éxito
        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}