<!-- resources/views/show_direcciones.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detalle de Dirección #{{ $direcciones->id }}</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $direcciones->cliente }}</p>
            <p><strong>Fecha:</strong> {{ $direcciones->fecha }}</p>
            <p><strong>Total:</strong> ${{ number_format($direcciones->total, 2) }}</p>

            <!-- Si tienes más detalles, agrégales aquí -->
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('direcciones.index') }}" class="btn btn-secondary">Volver a la lista de Direcciones</a>
    </div>
</div>
@endsection