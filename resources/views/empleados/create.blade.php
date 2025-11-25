@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Registro de Nuevo Empleado</h1>
    
    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary mb-3">
        Ver Empleados Registrados
    </a>

    {{-- 
        El action apunta a la ruta empleados.store (POST), que 
        será el método para guardar los datos en la base de datos.
    --}}
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf {{-- ¡Directiva de seguridad obligatoria en Laravel! --}}

        {{-- FILA 1: Nombre, Cédula, Sexo --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="nombre" class="form-label">Nombre Completo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="id_cedula" class="form-label">Cédula:</label>
                <input type="text" class="form-control" id="id_cedula" name="id_cedula" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="sexo" class="form-label">Sexo:</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="">Seleccione...</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
        </div>

        {{-- FILA 2: Fecha Nacimiento, Lugar Nacimiento, Teléfono --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento:</label>
                <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
        </div>

        {{-- FILA 3: Profesión, Dirección, Email --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="profesion" class="form-label">Profesión:</label>
                <input type="text" class="form-control" id="profesion" name="profesion" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        {{-- FILA 4: Ficha, Situación, Salario Base --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="ficha" class="form-label">Nro. Ficha:</label>
                <input type="number" class="form-control" id="ficha" name="ficha" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="situacion" class="form-label">Situación (Activo/Inactivo):</label>
                <input type="text" class="form-control" id="situacion" name="situacion" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="salario_base" class="form-label">Salario Base:</label>
                <input type="number" step="0.01" class="form-control" id="salario_base" name="salario_base" required>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-4">Guardar Empleado</button>
    </form>
</div>
@endsection