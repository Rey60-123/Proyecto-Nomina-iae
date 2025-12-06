@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Título de la vista estandarizado --}}
    <h1>Editar Tipo de Préstamo</h1>
    
    {{-- Botón para volver al índice (Estandarizado) --}}
    <a href="{{ route('tipo_prestamos.index') }}" class="btn btn-secondary mb-3">
        Volver a Tipos de Préstamos
    </a>

    {{-- Formulario para actualizar el Tipo de Préstamo --}}
    <form action="{{ route('tipo_prestamos.update', $tipo->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Directiva obligatoria para la actualización en Laravel --}}

        {{-- FILA 1: Código y Descripción (Organizados en 2 columnas) --}}
        <div class="row">
            {{-- Campo Código --}}
            <div class="col-md-6 mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" 
                       value="{{ $tipo->codigo }}" required>
            </div>

            {{-- Campo Descripción --}}
            <div class="col-md-6 mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" 
                       value="{{ $tipo->descripcion }}" required>
            </div>
        </div>

        {{-- Botones de acción estandarizados (con margen superior) --}}
        <button type="submit" class="btn btn-primary mt-4">Actualizar Tipo de Préstamo</button>
        <a href="{{ route('tipo_prestamos.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
@endsection