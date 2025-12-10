<!-- resources/views/Niveles Funcionales/crear_departamentos.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Crear Departamento</h1>

    <form method="POST" action="{{ route('departamentos.store') }}">
        @csrf

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">Cancelar</a>
        
    </form>
</div>
@endsection
