{{-- Asume que usas un layout base como 'layouts.app' --}}
@extends('layouts.app') 

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-dark text-white">
            Examinando el Archivo de Aumentos
        </div>
        
        {{-- Mensajes de Sesión (Éxito o Error) --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0" id="tiposAumentosTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 20%;">Tipo</th>
                            <th scope="col" style="width: 80%;">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tiposAumento as $tipo)
                        <tr data-id="{{ $tipo->id }}" data-tipo="{{ $tipo->tipo }}">
                            <td>{{ $tipo->tipo }}</td>
                            <td>{{ $tipo->descripcion }}</td>
                        </tr>
                        @endforeach
                        
                        @if(count($tiposAumento) === 0)
                            <tr>
                                <td colspan="2" class="text-center text-muted">No hay tipos de aumentos registrados.</td>
                            </tr>
                        @endif
                        
                        {{-- Agregar filas vacías para simular el espacio de la imagen --}}
                        @for ($i = 0; $i < (10 - count($tiposAumento) > 0 ? 10 - count($tiposAumento) : 0); $i++)
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center pt-3">
        <a href="{{ route('tipos_Aumentos.create') }}" class="btn btn-primary btn-sm me-2" title="Agregar nuevo registro">
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
        const table = document.getElementById('tiposAumentosTable');
        const btnEditar = document.getElementById('btnEditar');
        const btnBorrar = document.getElementById('btnBorrar');
        const deleteForm = document.getElementById('deleteForm');
        let selectedRow = null;
        let selectedId = null;

        table.querySelectorAll('tbody tr').forEach(row => {
            // Solo se permite seleccionar filas con datos (donde el ID está presente)
            if (row.getAttribute('data-id')) { 
                row.addEventListener('click', function() {
                    // Deseleccionar fila anterior
                    if (selectedRow) {
                        selectedRow.classList.remove('table-primary');
                    }
                    
                    // Seleccionar nueva fila
                    this.classList.add('table-primary');
                    selectedRow = this;
                    selectedId = this.getAttribute('data-id');
                    const selectedTipo = this.getAttribute('data-tipo');

                    // Habilitar botones
                    btnEditar.disabled = false;
                    btnBorrar.disabled = false;
                    
                    // Configurar acción de Editar
                    btnEditar.onclick = function() {
                        window.location.href = "{{ url('tipos_Aumentos') }}/" + selectedId + "/edit";
                    };

                    // Configurar acción de Borrar (usando el formulario)
                    btnBorrar.onclick = function(e) {
                        e.preventDefault();
                        if(confirm('¿Está seguro de que desea eliminar el Tipo de Aumento: ' + selectedTipo + '?')) {
                            // Configura la URL del formulario DELETE
                            deleteForm.action = "{{ url('tipos_Aumentos') }}/" + selectedId;
                            deleteForm.submit();
                        }
                    };
                });
            }
        });
    });
</script>
@endsection