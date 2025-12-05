@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>detalles de frecuencias de pago</h1>

    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('tipo_frecuencia_pagos.create') }}" class="btn btn-success mb-3">
        + Registrar Nueva Frecuencia de pago
    </a>

    @if($frecuenciaPago->isEmpty())
        <div class="alert alert-warning">
            Aún no hay freuencias registradas.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($frecuenciaPago as $frecuencia)
                <tr>
                    <td>{{ $frecuencia->id }}</td>
                    <td>{{ $frecuencia->descripcion_frecuencia }}</td>
                    <td class="d-flex justify-content-center">
                        {{-- BOTÓN DE ACTUALIZAR (EDITAR) --}}
                        <a href="{{ route('tipo_frecuencia_pagos.edit', $frecuencia) }}" class="btn btn-sm btn-primary me-2" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>
    
                        {{-- BOTÓN DE ELIMINAR (usando un formulario POST para seguridad) --}}
                        <form action="{{ route('tipo_frecuencia_pagos.destroy', $frecuencia->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este registro?');">
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