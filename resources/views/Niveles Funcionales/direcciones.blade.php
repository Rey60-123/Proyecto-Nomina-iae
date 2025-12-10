<!-- resources/views/Niveles Funcionales/direcciones.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Gestión de Direcciones</h2>

    <div class="mb-3">
        <a href="{{ route('direcciones.create') }}" class="btn btn-primary">+ Agregar Nueva Dirección</a>
        
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($direcciones as $direccion)
            <tr>
                <td>{{ $direccion->codigo }}</td>
                <td>{{ $direccion->descripcion }}</td>
                <td>
                    <a href="{{ route('direcciones.edit', $direccion->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar este registro?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-secondary" onclick="window.close()">Cerrar</button>
    
</div>
@endsection