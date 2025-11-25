<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;


Route::get('/', function () {
    return view('welcome');
});



// 1. Ruta para mostrar el formulario de creación de un nuevo empleado
Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');

// 2. Ruta para procesar el formulario (se usará en el futuro)
Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

// 3. Ruta para mostrar la lista de todos los empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');