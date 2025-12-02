@extends('layout')

@section('title', 'Listado de Productos')

@section('content')

    {{-- Título General de la Página (Opcional, pero ayuda a ubicar) --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inventario Global</h1>
        
        <a href="{{ route('inventory.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
    </div>

    {{-- TARJETA PRINCIPAL (Estilo idéntico al Dashboard) --}}
    <div class="card shadow-sm border-0">
        
        {{-- CARD HEADER: Título y Botón de Acción --}}
        <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-box-seam"></i> Listado Completo de Productos
            </h6>
            
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Nuevo Producto
            </a>
        </div>

        {{-- CARD BODY: Tabla sin padding (p-0) para que toque los bordes --}}
        <div class="card-body p-0">
            @if ($products->isEmpty())
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    <em>No hay productos registrados.</em>
                </div>
            @else
                <div class="table-responsive">
                    {{-- Estilo de tabla idéntico al Dashboard: table-hover, align-middle --}}
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light"> {{-- Cabecera gris clara, igual que dashboard --}}
                            <tr>
                                <th class="ps-4">ID</th> {{-- ps-4: Un poco de padding a la izq --}}
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th class="text-center">Stock</th>
                                <th class="text-end pe-4">Acciones</th> {{-- pe-4: Padding a la derecha --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="ps-4 text-muted small">#{{ $product->id }}</td>
                                
                                <td>
                                    {{-- Badge gris suave --}}
                                    <span class="badge bg-light text-dark border border-secondary-subtle">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                
                                <td class="fw-medium text-dark">{{ $product->name }}</td>
                                
                                <td>{{ number_format($product->price, 2) }} €</td>
                                
                                {{-- LÓGICA DE STOCK (Idéntica al Dashboard) --}}
                                <td class="text-center">
                                    @if($product->stock < 5)
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-triangle"></i> {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            {{ $product->stock }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar {{ $product->name }}?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger " title="Borrar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection