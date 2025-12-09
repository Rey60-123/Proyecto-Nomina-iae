@extends('layouts.app') 

@section('content')
<div class="container">
    {{-- Título de la vista --}}
    <h1>Agregar Tipo de Préstamo</h1>
    
    {{-- Botón de referencia a la otra vista (Índice de Tipos de Préstamos) --}}
    <a href="{{ route('tipo_prestamos.index') }}" class="btn btn-secondary mb-3">
        Ver Tipos de Préstamos Registrados
    </a>

    {{-- Formulario para guardar el nuevo Tipo de Préstamo --}}
    <form action="{{ route('tipo_prestamos.store') }}" method="POST">
        @csrf {{-- Directiva de seguridad obligatoria en Laravel --}}

        {{-- FILA 1: Código y Descripción --}}
        {{-- Usamos la estructura de columna de Bootstrap para organizar los campos. --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
        </div>
        
        {{-- Botones de acción estandarizados --}}
        <button type="submit" class="btn btn-primary mt-4">Guardar Tipo de Préstamo</button>
        <a href="{{ route('tipo_prestamos.index') }}" class="btn btn-secondary mt-4">Cancelar/Volver</a>
    </form>
</div>
@endsection