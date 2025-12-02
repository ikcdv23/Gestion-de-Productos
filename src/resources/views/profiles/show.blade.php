@extends('layout')

@section('content')
    <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; background-color: #f9f9f9;">
        
        {{-- DATOS DEL PERFIL --}}
        <h2 style="color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            Perfil: {{ $profile->name }}
        </h2>

        {{-- DATOS DEL USUARIO VINCULADO (El puente por email) --}}
        <div style="margin-top: 20px;">
            <h3 style="color: #555;">Datos del Usuario Asociado:</h3>
            
            @if($profile->user)
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">
                        <strong>Nombre Real:</strong> {{ $profile->user->name }}
                    </li>
                    <li style="margin-bottom: 10px;">
                        <strong>Email (Vínculo):</strong> {{ $profile->user->email }}
                    </li>
                    <li style="margin-bottom: 10px;">
                        <strong>Rol:</strong> 
                        <span style="color: {{ $profile->user->rol == 'admin' ? 'red' : 'green' }}; font-weight: bold;">
                            {{ $profile->user->rol }}
                        </span>
                    </li>
                </ul>
            @else
                <p style="color: red;">Error: No se encontró un usuario con el email {{ $profile->email }}</p>
            @endif
        </div>

        <br>
        <a href="{{ route('inventory.dashboard') }}" style="text-decoration: none; color: #007bff;">
            ← Volver al Dashboard
        </a>
    </div>
@endsection