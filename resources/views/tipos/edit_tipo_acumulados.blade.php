@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Editar/Actualizar tipo de Acumulado</h1>
    
    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('tipo_acumulados.index') }}" class="btn btn-secondary mb-3">
        Ver detalles de los acumulados
    </a>

    {{-- 
        El action apunta a la ruta empleados.store (POST), que 
        será el método para guardar los datos en la base de datos.
    --}}
    <form action="{{ route('tipo_acumulados.update' , $tipoAcumulado) }}" method="POST">
        @csrf {{-- ¡Directiva de seguridad obligatoria en Laravel! --}}
        @method('PATCH')

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@error('descripcion_tipo')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror


        {{-- FILA 1: Nombre, Cédula, Sexo --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="nombre" class="form-label">Nuevo Acumulado:</label>
                <input type="text" class="form-control" id="frecuencia" name="descripcion_acumulados" required>
                <label for="nombre" class="form-label">Abreviacion del Nuevo Acumulado:</label>
                <input type="text" class="form-control" id="frecuencia" name="descripcion_tipo" required>
            </div>  
        </div>
        <button type="submit" class="btn btn-primary mt-4">Guardar Acumulado</button>
    </form>
</div>
@endsection