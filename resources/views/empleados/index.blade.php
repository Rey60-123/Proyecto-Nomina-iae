@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Listado de Empleados</h1>

    {{-- Botón de referencia a la otra vista --}}
    <a href="{{ route('empleados.create') }}" class="btn btn-success mb-3">
        + Registrar Nuevo Empleado
    </a>

    @if($empleados->isEmpty())
        <div class="alert alert-warning">
            Aún no hay empleados registrados.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Ficha</th>
                    <th>Salario Base</th>
                    <th>Situación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id_empleado }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->id_cedula }}</td>
                    <td>{{ $empleado->ficha }}</td>
                    <td>Bs {{ number_format($empleado->salario_base, 2) }}</td>
                    <td>{{ $empleado->situacion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection