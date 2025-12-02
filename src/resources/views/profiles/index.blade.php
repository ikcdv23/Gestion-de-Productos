@extends('layouts.layout')

@section('title', 'Listado de Usuarios')

@section('content')
    
    <h2 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 5px;">Gestión de Usuarios</h2>
    
    {{-- Enlace para acceder al perfil simulado --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('user.profile', ['user' => 1]) }}" style="text-decoration: none; color: white;">
            <button style="background-color: #007bff; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px;">
                👤 Ver Perfil de Usuario (ID 1)
            </button>
        </a>
        <a href="{{ route('inventory.dashboard') }}" style="margin-left: 15px; color: #007bff; text-decoration: none;">
            Volver al Dashboard
        </a>
    </div>

    {{-- Lista de Usuarios (Asumiendo que pasamos una variable $users) --}}
    @if (!isset($users) || $users->isEmpty())
        <p style="color: #666; font-style: italic;">No hay un listado de usuarios disponible aquí. Usa el botón superior para ver el perfil simulado.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="background-color: #e0e0e0;">
                    <th style="padding: 12px; border: 1px solid #ccc;">ID</th>
                    <th style="padding: 12px; border: 1px solid #ccc;">Nombre</th>
                    <th style="padding: 12px; border: 1px solid #ccc;">Email</th>
                    <th style="padding: 12px; border: 1px solid #ccc;">Rol</th>
                    <th style="padding: 12px; border: 1px solid #ccc;">Contraseña</th>
                    <th style="padding: 12px; border: 1px solid #ccc; width: 150px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr style="background-color: {{ $loop->even ? '#f9f9f9' : 'white' }};">
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">{{ $user->id }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $user->name }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $user->email }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold; color: {{ $user->role === 'admin' ? '#dc3545' : '#28a745' }};">
                        {{ $user->role }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $user->password }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">
                        <a href="{{ route('user.profile', $user) }}" style="color: #007bff; text-decoration: none;">Ver Perfil</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection