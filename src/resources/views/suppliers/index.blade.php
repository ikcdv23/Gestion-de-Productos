@extends('layout')

@section('title', 'Gestión de Proveedores')

@section('content')

    {{-- CABECERA FLEXBOX --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Proveedores</h1>
        
        <div>
            <a href="{{ route('inventory.dashboard') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-building-add"></i> Nuevo Proveedor
            </a>
        </div>
    </div>

    {{-- TARJETA PRINCIPAL --}}
    <div class="card shadow-sm border-0">
        
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-truck"></i> Listado de Empresas
            </h6>
        </div>

        <div class="card-body p-0">
            @if ($suppliers->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-shop-window fs-1 d-block mb-3"></i>
                    <p class="mb-0">No hay proveedores registrados.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 5%">ID</th>
                                <th style="width: 25%">Nombre Empresa</th>
                                <th>Contacto Principal</th>
                                <th>Teléfono</th>
                                <th class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td class="ps-4 text-muted small">#{{ $supplier->id }}</td>
                                
                                <td class="fw-bold text-dark">
                                    <i class="bi bi-building text-secondary me-1"></i>
                                    {{ $supplier->name }}
                                </td>
                                
                                <td>
                                    <i class="bi bi-person text-muted small"></i> 
                                    {{ $supplier->contact_person }}
                                </td>

                                <td>
                                    {{-- Lógica visual para teléfono nulo --}}
                                    @if($supplier->phone)
                                        <a href="tel:{{ $supplier->phone }}" class="text-decoration-none text-dark">
                                            <i class="bi bi-telephone-fill text-success small"></i> {{ $supplier->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted small"><em>-- No registrado --</em></span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar al proveedor {{ $supplier->name }}?');">
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