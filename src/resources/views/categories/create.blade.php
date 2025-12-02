@extends('layouts.layout')

@section('title', 'Crear Nueva Categoría')

@section('content')

{{-- Contenedor limitado a 600px para que el formulario no se "estire" demasiado --}}
<div class="container" style="max-width: 600px;">

    {{-- Encabezado y Botón "Cancelar" --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nueva Categoría</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-x-lg"></i> Cancelar
        </a>
    </div>

    {{-- TARJETA DEL FORMULARIO --}}
    <div class="card shadow-sm border-0">
        
        {{-- Header blanco simple para creación --}}
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-success">
                <i class="bi bi-plus-circle-fill"></i> Rellena los datos
            </h6>
        </div>

        <div class="card-body p-4">

            {{-- Alerta de errores generales --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-2"></i> 
                    <strong>¡Atención!</strong> Revisa los campos marcados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                {{-- CAMPO 1: NOMBRE --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nombre de la Categoría</label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" placeholder="Ej: Herramientas, Electrónica..." required autofocus>
                    
                    {{-- Mensaje de error específico --}}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- CAMPO 2: DESCRIPCIÓN (Textarea) --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Descripción (Opcional)</label>
                    {{-- Recuerda: El contenido del textarea va DENTRO de las etiquetas, no en 'value' --}}
                    <textarea name="description" id="description" rows="4" 
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe brevemente el tipo de productos que contendrá...">{{ old('description') }}</textarea>
                    
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BOTÓN DE GUARDAR (Ocupando todo el ancho) --}}
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success shadow-sm fw-bold">
                        <i class="bi bi-save"></i> Guardar Categoría
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection