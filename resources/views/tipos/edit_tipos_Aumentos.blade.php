@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4>Modificar Tipo de Aumento: {{ $tipoAumento->tipo }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('tipo_Aumentos.update', $tipoAumento->id) }}" method="POST">
                @csrf
                @method('PUT') 

                {{-- Campo Tipo (antes Código) --}}
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo:</label>
                    {{-- El campo Tipo se mantiene visible, pero puede ser de solo lectura si así lo requiere la lógica de negocio --}}
                    <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" 
                           value="{{ old('tipo', $tipoAumento->tipo) }}" required maxlength="50">
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo Descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" 
                           value="{{ old('descripcion', $tipoAumento->descripcion) }}" required>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-start pt-3">
                    <button type="submit" class="btn btn-success me-2">Guardar Cambios</button>
                    <a href="{{ route('tipo_Aumentos.index') }}" class="btn btn-secondary">Cancelar/Cerrar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection