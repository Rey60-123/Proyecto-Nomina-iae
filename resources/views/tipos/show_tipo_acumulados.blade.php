@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Listado de Acumulados</h1>

    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('tipo_acumulados.create') }}" class="btn btn-success mb-3">
        + Registrar Nueva Acumulado
    </a>

    @if($tipoAcumulado->isEmpty())
        <div class="alert alert-warning">
            Aún no hay acumulados registradas.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoAcumulado as $acumulado)
                <tr>
                    <td>{{ $acumulado->descripcion_tipo }}</td>
                    <td>{{ $acumulado->descripcion_acumulados }}</td>
                    <td class="d-flex justify-content-center">
                        {{-- BOTÓN DE ACTUALIZAR (EDITAR) --}}
                        <a href="{{ route('tipo_acumulados.edit', $acumulado->id) }}" class="btn btn-sm btn-primary me-2" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>
    
                        {{-- BOTÓN DE ELIMINAR (usando un formulario POST para seguridad) --}}
                        <form action="{{ route('tipo_acumulados.destroy', $acumulado->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este registro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection