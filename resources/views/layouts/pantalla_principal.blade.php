@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Bienvenido al sistema de Nomina</h1>

    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('empleados.create') }}" class="btn btn-success mb-3">
        + Registrar Nuevo Empleado
    </a>

</div>
@endsection