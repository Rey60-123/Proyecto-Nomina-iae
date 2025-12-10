<!-- resources/views/Niveles Funcionales/edit_direcciones.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Dirección</h2>

    <form action="{{ route('direcciones.update', $direccion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $direccion->codigo }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $direccion->descripcion }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('direcciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection