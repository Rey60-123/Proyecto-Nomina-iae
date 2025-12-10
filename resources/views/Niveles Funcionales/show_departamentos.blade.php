<!-- resources/views/show_departamentos.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detalle de Departamento #{{ $departamentos->id }}</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $departamentos->cliente }}</p>
            <p><strong>Fecha:</strong> {{ $departamentos->fecha }}</p>
            <p><strong>Total:</strong> ${{ number_format($departamentos->total, 2) }}</p>

            <!-- Si tienes más detalles, agrégalos aquí -->
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">Volver a la lista de Departamentos</a>
    </div>
</div>
@endsection