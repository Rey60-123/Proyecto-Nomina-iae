@extends('layouts.app') 
 
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Agregar Nuevo Tipo de Aumento</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('tipos_Aumentos.store') }}" method="POST">
                @csrf
                
                {{-- Campo Tipo (antes Código) --}}
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required maxlength="50" value="{{ old('tipo') }}">
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Campo Descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required value="{{ old('descripcion') }}">
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-start pt-3">
                    <button type="submit" class="btn btn-success me-2">Guardar</button>
                    <a href="{{ route('tipos_Aumentos.index') }}" class="btn btn-secondary">Cancelar/Cerrar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection