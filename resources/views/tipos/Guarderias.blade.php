@extends('layouts.app') 

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-dark text-white">
            Examinando el Archivo Guarderías
        </div>
        
        {{-- Mensajes de Sesión --}}
        @if(session('success'))
        <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger m-3">{{ session('error') }}</div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0" id="guarderiasTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 20%;">Código</th>
                            <th scope="col" style="width: 80%;">Descripción (Nombre)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guarderias as $guarderia)
                        <tr data-id="{{ $guarderia->id }}" data-nombre="{{ $guarderia->nombre }}">
                            <td>{{ $guarderia->codigo_guarderia }}</td>
                            <td>{{ $guarderia->nombre }}</td>
                        </tr>
                        @endforeach
                        
                        @if(count($guarderias) === 0)
                            <tr>
                                <td colspan="2" class="text-center text-muted">No hay guarderías registradas.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center pt-3">
        <a href="{{ route('Guarderias.create') }}" class="btn btn-primary btn-sm me-2" title="Agregar nuevo registro">
            Agregar
        </a>
        
        <button type="button" class="btn btn-warning btn-sm me-2" id="btnEditar" title="Editar registro seleccionado" disabled>
            Modificar
        </button>
        
        <form id="deleteForm" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm me-2" id="btnBorrar" title="Eliminar registro seleccionado" disabled>
                Borrar
            </button>
        </form>

        <button type="button" class="btn btn-secondary btn-sm" onclick="window.close()" title="Cerrar la ventana">
            Cerrar
        </button>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('guarderiasTable');
        const btnEditar = document.getElementById('btnEditar');
        const btnBorrar = document.getElementById('btnBorrar');
        const deleteForm = document.getElementById('deleteForm');
        let selectedRow = null;
        let selectedId = null;

        table.querySelectorAll('tbody tr').forEach(row => {
            if (row.getAttribute('data-id')) { 
                row.addEventListener('click', function() {
                    if (selectedRow) {
                        selectedRow.classList.remove('table-primary');
                    }
                    this.classList.add('table-primary');
                    selectedRow = this;
                    selectedId = this.getAttribute('data-id');
                    const selectedNombre = this.getAttribute('data-nombre');

                    btnEditar.disabled = false;
                    btnBorrar.disabled = false;
                    
                    btnEditar.onclick = function() {
                        window.location.href = "{{ url('Guarderias') }}/" + selectedId + "/edit";
                    };

                    btnBorrar.onclick = function(e) {
                        e.preventDefault();
                        if(confirm('¿Está seguro de que desea eliminar la Guardería: ' + selectedNombre + '?')) {
                            deleteForm.action = "{{ url('Guarderias') }}/" + selectedId;
                            deleteForm.submit();
                        }
                    };
                });
            }
        });
    });
</script>
@endsection