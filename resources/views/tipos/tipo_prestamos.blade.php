@extends('layouts.app') 

@section('content')
<div class="container">
    {{-- Título de la vista --}}
    <h1>Tipos de Préstamos</h1>
    
    <hr>
    
    {{-- Mensajes de Sesión (Éxito) --}}
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif


    
    {{-- Botones de Acción Principal --}}
    <div class="mb-3 d-flex justify-content-between align-items-center">
        {{-- Botón para ir al formulario de creación --}}
        <a href="{{ route('tipo_prestamos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Tipo
        </a>
        
        {{-- Botón para cerrar (Útil si se abrió en una ventana o modal) --}}
        <button type="button" onclick="window.close()" class="btn btn-dark">
            Cerrar Vista
        </button>
    </div>
    
    {{-- Tabla de Tipos de Préstamos --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Descripción</th>
                    <th scope="col" style="width: 15%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->codigo }}</td>
                    <td>{{ $tipo->descripcion }}</td>
                    <td>
                        {{-- Botón Editar --}}
                        <a href="{{ route('tipo_prestamos.edit', $tipo->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        
                        {{-- Formulario para Borrar --}}
                        <form action="{{ route('tipo_prestamos.destroy', $tipo->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar el tipo de préstamo: {{ $tipo->descripcion }}?')">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if(count($tipos) === 0)
                    <tr>
                        <td colspan="3" class="text-center">No hay tipos de préstamos registrados.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection