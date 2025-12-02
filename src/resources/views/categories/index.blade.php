@extends('layout')

@section('title', 'Gestión de Categorías')

@section('content')

    {{-- 1. CABECERA: Título y Botones alineados con Flexbox --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Categorías</h1>
        
        <div>
            <a href="{{ route('inventory.dashboard') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg"></i> Crear Nueva Categoría
            </a>
        </div>
    </div>

    {{-- NOTA MENTOR: 
         He eliminado el bloque de @if(session('success')) aquí 
         porque YA lo tenemos en el layout.blade.php. 
         Si lo dejas, saldrá duplicado. ¡Principio DRY! 
    --}}

    {{-- 2. TARJETA CONTENEDORA (Estilo "Clean Card") --}}
    <div class="card shadow-sm border-0">
        
        {{-- Cabecera de la tarjeta --}}
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-tags-fill"></i> Listado Completo
            </h6>
        </div>

        {{-- Cuerpo de la tarjeta --}}
        <div class="card-body p-0">
            @if($categories->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                    <p class="mb-0">No hay categorías registradas en este momento.</p>
                </div>
            @else
                <div class="table-responsive">
                    {{-- 
                        table-striped: Hace el efecto cebra automático (adiós al $loop->even)
                        table-hover: Ilumina la fila al pasar el ratón 
                    --}}
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 5%">ID</th>
                                <th style="width: 20%">Nombre</th>
                                <th>Descripción</th> {{-- Tu columna original --}}
                                <th class="text-end pe-4" style="width: 15%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="ps-4 text-muted small">#{{ $category->id }}</td>
                                    
                                    <td class="fw-bold text-dark">
                                        {{ $category->name }}
                                        {{-- Extra: Badge opcional para ver cuántos productos tiene --}}
                                        <span class="badge bg-light text-secondary border ms-2">
                                            {{ $category->products->count() }} prod.
                                        </span>
                                    </td>
                                    
                                    <td class="text-secondary">
                                        {{ $category->description ?? 'Sin descripción' }}
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-primary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- Botón Borrar --}}
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar la categoría: {{ $category->name }} y todos sus productos?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Borrar">
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