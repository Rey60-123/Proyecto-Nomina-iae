<!-- resources/views/Niveles Funcionales/presupuesto.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Presupuesto</h1>

    <!-- Botón para abrir formulario de creación -->
    <a href="{{ route('presupuesto.create') }}" class="btn btn-primary mb-3">+ Agregar Nuevo Presupuesto</a>

    <!-- Lista de presupuestos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presupuestos as $presupuesto)
            <tr>
                <td>{{ $presupuesto->codigo }}</td>
                <td>{{ $presupuesto->descripcion }}</td>
                <td>
                    <a href="{{ route('presupuesto.edit', $presupuesto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('presupuesto.destroy', $presupuesto->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que desea eliminar?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para cerrar la ventana -->
    <div class="mt-3">
        <button class="btn btn-secondary" onclick="window.close()">Cerrar</button>
    </div>
</div>
@endsection