<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="dropdown">
        {{-- Título principal del Menú: Configuración --}}
        <button class="btn btn-dark dropdown-toggle" type="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
            ⚙️ Configuración
        </button>

        {{-- Contenedor principal del Menú --}}
        <ul class="dropdown-menu">

            {{-- Opción 1: Sin Submenú --}}
            <li><a class="dropdown-item" href="#">Opción 1: Usuarios</a></li>

            {{-- Opción 2: Sin Submenú --}}
            <li><a class="dropdown-item" href="#">Opción 2: Perfiles</a></li>

            {{-- SEPARADOR --}}
            <li><hr class="dropdown-divider"></li>

            {{-- **OPCIÓN 3: TIPOS (CON SUBMENÚ DESPLEGABLE)** --}}
            <li class="nav-item dropend">
                <a class="dropdown-item dropdown-toggle" href="#" id="submenuTipos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ✨ **3. Tipos**
                </a>
                {{-- Contenedor del Submenú --}}
                <ul class="dropdown-menu" aria-labelledby="submenuTipos">
                    {{-- Rutas Solicitadas --}}
                    <li><h6 class="dropdown-header">Gestionar Tipos</h6></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_nominas.index') }}">Tipo de Nóminas</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_frecuencia_pagos.index') }}">Tipo de Frecuencias de Pago</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_acumulados.index') }}">Tipo de Acumulados</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_ausencias.index') }}">Tipo de Ausencias</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_prestamos.index') }}">Tipo de Prestamos</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_Aumentos.index') }}">Tipo de Aumentos</a></li>
                    <li><a class="dropdown-item" href="{{ route('Guarderias.index') }}">Tipo de Guarderias</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_Liquidacion.index') }}">Tipo de Liquidaciones</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipo_ausencia.index') }}">Tipo de Ausencias</a></li>
                </ul>
            </li>

            {{-- SEPARADOR --}}
            <li><hr class="dropdown-divider"></li>

            {{-- Opciones Restantes (4 a 10) --}}
            <li><a class="dropdown-item" href="#">Opción 4: Monedas</a></li>
            <li><a class="dropdown-item" href="#">Opción 5: Departamentos</a></li>
            <li><a class="dropdown-item" href="#">Opción 6: Puestos</a></li>
            <li><a class="dropdown-item" href="#">Opción 7: Países</a></li>
            <li><a class="dropdown-item" href="#">Opción 8: Ciudades</a></li>
            <li><a class="dropdown-item" href="#">Opción 9: Permisos</a></li>
            <li><a class="dropdown-item" href="#">Opción 10: Logs</a></li>
        </ul>
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/empleados') }}">
                    Proyecto Nómina
                </a>
            </div>
        </nav>

        <main class="py-4">
            {{-- Aquí se inyectará el contenido de tus vistas (create.blade.php o index.blade.php) --}}
            @yield('content') 
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('.dropdown-menu a.dropdown-toggle').forEach(function(element){
            element.addEventListener('click', function(e) {
                let el = this.nextElementSibling;
                if (el && el.classList.contains('dropdown-menu')) {
                    e.preventDefault();
                    e.stopPropagation(); // Evitar que el evento cierre el menú principal
                    if(el.style.display === 'block'){
                        el.style.display = 'none';
                    } else {
                        el.style.display = 'block';
                    }
                }
            });
        });
    </script>
</body>
</html>

