@extends('layout') {{-- Asegúrate de que la ruta coincida con tu carpeta --}}

@section('title', 'Panel de Control')

@section('content')

    {{-- CABECERA DEL DASHBOARD --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>

        {{-- Botón de Acción Global --}}
        <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-folder-plus"></i> Nueva Categoría
        </a>
    </div>

    {{-- MENSAJES DE FEEDBACK (Ya lo tenemos en el layout, pero si quieres uno específico aquí) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- BUCLE EXTERNO: CATEGORÍAS (Ahora son Cards) --}}
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-12 mb-4"> {{-- Ocupa todo el ancho, margen inferior --}}

                <div class="card shadow-sm border-0">
                    {{-- CABECERA DE LA TARJETA (Título y Acciones de Categoría) --}}
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-folder2-open"></i> {{ $category->name }}
                            <span class="badge bg-secondary rounded-pill ms-2">{{ $category->products->count() }} prod.</span>
                        </h6>

                        {{-- Grupo de botones de acción --}}
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('products.create', ['category_id' => $category->id]) }}" class="btn btn-success"
                                title="Añadir Producto aquí">
                                <i class="bi bi-plus-lg"></i> Producto
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-secondary"
                                title="Editar Categoría">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- Formulario de borrado (Truco: Usamos un botón dentro del form) --}}
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Seguro? Se borrará la categoría y sus productos.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Borrar Categoría">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- CUERPO DE LA TARJETA (Tabla de Productos) --}}
                    <div class="card-body p-0">
                        @if($category->products->isEmpty())
                            <div class="p-4 text-center text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <em>No hay productos en esta categoría.</em>
                            </div>
                        @else
                            {{-- table-responsive: Permite scroll horizontal en móviles --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-end">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category->products as $product)
                                            <tr>
                                                <td class="fw-medium">{{ $product->name }}</td>
                                                <td>{{ number_format($product->price, 2) }} €</td>

                                                {{-- LÓGICA VISUAL DE STOCK --}}
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

                                                <td class="text-end">
                                                    <a href="{{ route('products.edit', $product) }}"
                                                        class="btn btn-sm btn-link text-decoration-none text-secondary">
                                                        Editar
                                                    </a>

                                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-link text-danger"
                                                            onclick="return confirm('¿Borrar producto?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection