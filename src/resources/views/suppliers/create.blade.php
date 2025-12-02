@extends('layout')
@section('title', 'Nuevo Proveedor')

@section('content')
<div class="container" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Alta de Proveedor</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary btn-sm">Cancelar</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-success"><i class="bi bi-building-add"></i> Datos de la Empresa</h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                
                {{-- Nombre Empresa --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre de la Empresa</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    {{-- Contacto --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Persona de Contacto</label>
                        <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person') }}">
                    </div>
                    {{-- Teléfono --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Teléfono</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-success fw-bold">Guardar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection