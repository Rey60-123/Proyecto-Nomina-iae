<!-- resources/views/Niveles Funcionales/departamentos.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Departamentos</h1>

    <div class="mb-3">
        <a href="{{ route('departamentos.create') }}" class="btn btn-primary">+ Agregar Nuevo Departamento</a>
        
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
            @foreach($departamentos as $dep)
            <tr>
                <td>{{ $dep->codigo }}</td>
                <td>{{ $dep->descripcion }}</td>
                <td>
                    <a href="{{ route('departamentos.edit', $dep) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('departamentos.destroy', $dep) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar este departamento?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-secondary" onclick="window.close()">Cerrar </button>
</div>
@endsection