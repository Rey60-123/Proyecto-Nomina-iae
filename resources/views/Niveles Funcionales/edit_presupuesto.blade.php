<!-- resources/views/Niveles Funcionales/edit_presupuesto.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Presupuesto</h1>

    <form action="{{ route('presupuesto.update', $presupuesto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="codigo" class="form-label">Código:</label>
            <input type="text" id="codigo" name="codigo" value="{{ $presupuesto->codigo }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ $presupuesto->descripcion }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('presupuesto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
