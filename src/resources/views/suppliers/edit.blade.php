@extends('layout')
@section('title', 'Editar Proveedor')

@section('content')
<div class="container" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Editar Proveedor</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary btn-sm">Cancelar</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 fw-bold"><i class="bi bi-pencil-square"></i> Editando: {{ $supplier->name }}</h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre de la Empresa</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $supplier->name) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Persona de Contacto</label>
                        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $supplier->contact_person) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Teléfono</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}">
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary fw-bold">Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection