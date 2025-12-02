@extends('layout')

@section('title', 'Editar Producto')

@section('content')

<div class="container" style="max-width: 800px;">

    {{-- Encabezado con Botón de Volver --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edición de Producto</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow-sm border-0">
        {{-- CARD HEADER: Azul para diferenciarlo visualmente de "Crear" (opcional) --}}
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 fw-bold">
                <i class="bi bi-pencil-square"></i> Editando: {{ $product->name }}
            </h6>
        </div>

        <div class="card-body p-4">

            {{-- Alertas de Error Generales --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <strong>Atención:</strong> Revisa los campos marcados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT') {{-- CRUCIAL: Transforma el POST en PUT para Laravel --}}

                {{-- FILA 1: CATEGORÍA y PROVEEDOR --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="category_id" class="form-label fw-bold">Categoría</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{-- Lógica: Si falla validación (old) O si coincide con la BDD ($product) --}}
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="supplier_id" class="form-label fw-bold">Proveedor</label>
                        <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" 
                                    {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- FILA 2: NOMBRE --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nombre del Producto</label>
                    {{-- value: old('name', $product->name) -> Primero mira si hay un intento fallido previo, si no, usa el de la BDD --}}
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $product->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- FILA 3: PRECIO y STOCK --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="price" class="form-label fw-bold">Precio</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $product->price) }}" required>
                            <span class="input-group-text">€</span>
                        </div>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-bold">Stock Actual</label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" 
                               value="{{ old('stock', $product->stock) }}" required>
                        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                    {{-- Botón azul (Primary) para indicar actualización --}}
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="bi bi-arrow-repeat"></i> Actualizar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection