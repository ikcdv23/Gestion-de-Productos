@extends('layout')

@section('title', 'Editar Categoría')

@section('content')

    {{-- Contenedor centrado para que el formulario no sea excesivamente ancho --}}
    <div class="container" style="max-width: 600px;">

        {{-- Encabezado con Botón de Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar Categoría</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Cancelar
            </a>
        </div>

        {{-- Card Principal --}}
        <div class="card shadow-sm border-0">

            {{-- Header Azul para indicar "Edición" (Consistencia con Productos) --}}
            <div class="card-header bg-primary text-white py-3">
                <h6 class="m-0 fw-bold">
                    <i class="bi bi-pencil-fill"></i> Editando: {{ $category->name }}
                </h6>
            </div>

            <div class="card-body p-4">

                {{-- Mostrar errores generales si los hay --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Revisa los errores en el formulario.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- ¡Vital para actualizaciones! --}}

                    {{-- CAMPO 1: NOMBRE --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nombre de la Categoría</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" required>

                        {{-- Feedback de error --}}
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CAMPO 2: DESCRIPCIÓN (Textarea) --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descripción</label>
                        {{--
                        NOTA MENTOR: Los textareas NO tienen atributo 'value'.
                        El contenido va DENTRO de las etiquetas de apertura y cierre.
                        --}}
                        <textarea name="description" id="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BOTONES DE ACCIÓN --}}
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <i class="bi bi-arrow-repeat"></i> Actualizar Categoría
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection