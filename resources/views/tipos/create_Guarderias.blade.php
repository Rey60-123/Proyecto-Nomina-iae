@extends('layouts.app') 

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Incluyendo registro de Guardería</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('Guarderias.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- Cod. Guardería --}}
                    <div class="col-md-4 mb-3">
                        <label for="codigo_guarderia" class="form-label">Cód. Guardería:</label>
                        <input type="text" class="form-control @error('codigo_guarderia') is-invalid @enderror" id="codigo_guarderia" name="codigo_guarderia" required value="{{ old('codigo_guarderia') }}" maxlength="50">
                        @error('codigo_guarderia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Sucursal (Ubicación) --}}
                    <div class="col-md-8 mb-3">
                        <label for="sucursal_ubicacion" class="form-label">Sucursal (Ubicación):</label>
                        <input type="text" class="form-control @error('sucursal_ubicacion') is-invalid @enderror" id="sucursal_ubicacion" name="sucursal_ubicacion" value="{{ old('sucursal_ubicacion') }}" maxlength="100">
                        @error('sucursal_ubicacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- RIF --}}
                    <div class="col-md-6 mb-3">
                        <label for="rif" class="form-label">RIF:</label>
                        <input type="text" class="form-control @error('rif') is-invalid @enderror" id="rif" name="rif" value="{{ old('rif') }}" maxlength="50">
                        @error('rif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Nombre --}}
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required value="{{ old('nombre') }}" maxlength="255">
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Dirección --}}
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" maxlength="500">
                    @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    {{-- Teléfonos --}}
                    <div class="col-md-4 mb-3">
                        <label for="telefonos" class="form-label">Teléfonos:</label>
                        <input type="text" class="form-control @error('telefonos') is-invalid @enderror" id="telefonos" name="telefonos" value="{{ old('telefonos') }}" maxlength="100">
                        @error('telefonos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Nro. Registro --}}
                    <div class="col-md-4 mb-3">
                        <label for="nro_registro" class="form-label">Nro. Registro:</label>
                        <input type="text" class="form-control @error('nro_registro') is-invalid @enderror" id="nro_registro" name="nro_registro" value="{{ old('nro_registro') }}" maxlength="100">
                        @error('nro_registro') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Mont. Inscripción (Base) --}}
                    <div class="col-md-6 mb-3">
                        <label for="monto_inscripcion_base" class="form-label">Mont. Inscripción (Base):</label>
                        <input type="number" step="0.01" class="form-control @error('monto_inscripcion_base') is-invalid @enderror" id="monto_inscripcion_base" name="monto_inscripcion_base" required value="{{ old('monto_inscripcion_base', 0.00) }}">
                        @error('monto_inscripcion_base') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Mont. Mensual (Base) --}}
                    <div class="col-md-6 mb-3">
                        <label for="monto_mensual_base" class="form-label">Mont. Mensual (Base):</label>
                        <input type="number" step="0.01" class="form-control @error('monto_mensual_base') is-invalid @enderror" id="monto_mensual_base" name="monto_mensual_base" required value="{{ old('monto_mensual_base', 0.00) }}">
                        @error('monto_mensual_base') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-success me-2">Aceptar</button>
                    <a href="{{ route('Guarderias.index') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection