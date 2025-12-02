@extends('layout')

@section('title', 'Crear Nuevo Producto')

@section('content')

{{-- Contenedor centrado y limitado en anchura para que no se estire en pantallas gigantes --}}
<div class="container" style="max-width: 800px;">
    
    {{-- Título y botón de volver --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alta de Producto</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>

    {{-- CARD PRINCIPAL (Estilo unificado con Dashboard/Index) --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-box-seam-fill"></i> Formulario de Nuevo Producto
            </h6>
        </div>

        <div class="card-body p-4">
            
            {{-- Mantenemos la alerta general por si hay errores genéricos, pero los específicos irán campo a campo --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i> 
                    <strong>¡Ups!</strong> Por favor, revisa los campos marcados en rojo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                {{-- FILA 1: CATEGORÍA y PROVEEDOR (Dos columnas en pantallas medianas) --}}
                <div class="row mb-3">
                    
                    {{-- CAMPO CATEGORÍA --}}
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="category_id" class="form-label fw-bold">Categoría</label>
                        {{-- 
                            clase 'form-select': Estilo estándar de Bootstrap para desplegables.
                            clase 'is-invalid': Si hay error en 'category_id', el borde se pone rojo.
                        --}}
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona Categoría --</option>
                            @foreach($categories as $category)
                                @php
                                    // Tu lógica de preselección mantenida intacta
                                    $selected = old('category_id');
                                    if (!$selected && isset($selectedCategoryId)) {
                                        $selected = $selectedCategoryId;
                                    }
                                @endphp
                                <option value="{{ $category->id }}" {{ $selected == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Mensaje de error específico para este campo --}}
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CAMPO PROVEEDOR --}}
                    <div class="col-md-6">
                        <label for="supplier_id" class="form-label fw-bold">Proveedor</label>
                        <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona Proveedor --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- FILA 2: NOMBRE DEL PRODUCTO --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nombre del Producto</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" placeholder="Ej: Laptop Gaming HP..." required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- FILA 3: PRECIO y STOCK --}}
                <div class="row mb-4">
                    
                    {{-- CAMPO PRECIO con Input Group (Símbolo de Euro) --}}
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="price" class="form-label fw-bold">Precio</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price') }}" required>
                            <span class="input-group-text bg-light">€</span>
                            {{-- Nota: El error debe ir fuera del input-group o configurarse especial --}}
                        </div>
                        @error('price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CAMPO STOCK --}}
                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-bold">Stock Inicial</label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" 
                               value="{{ old('stock') }}" required>
                        <div class="form-text text-muted">Aviso automático si es menor de 5.</div>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success text-white fw-bold shadow-sm">
                        <i class="bi bi-floppy"></i> Guardar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection