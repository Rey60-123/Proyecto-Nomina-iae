<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TipoNominaController;
use App\Http\Controllers\TipoFrecuenciaPagoController;
use App\Http\Controllers\TipoAcumuladosController;
use App\Http\Controllers\TipoPrestamoController;
use App\Http\Controllers\TipoAumentoController;
use App\Http\Controllers\GuarderiaController;
use App\Http\Controllers\TipoLiquidacionController;
use App\Http\Controllers\TipoAusenciaController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('empleados', EmpleadoController::class);

// 1. Ruta para mostrar el formulario de creación de un nuevo empleado
//Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');

// 2. Ruta para procesar el formulario (se usará en el futuro)
//Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

// 3. Ruta para mostrar la lista de todos los empleados
//Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');

Route::resource('tipo_nominas', TipoNominaController::class);

Route::resource('tipo_frecuencia_pagos' , TipoFrecuenciaPagoController::class);

Route::resource('tipo_acumulados' , TipoAcumuladosController::class);

Route::resource('tipo_prestamos', TipoPrestamoController::class);

// Ejemplo usando Resource (Recomendado)
Route::resource('tipo_prestamos', TipoPrestamoController::class);


// Usamos el nombre de recurso adaptado: 'tipos_aumentos'
Route::resource('tipos_Aumentos', TipoAumentoController::class);



// Nombre de recurso: 'guarderias'
Route::resource('Guarderias', GuarderiaController::class);
Route::resource('tipo_Liquidacion', TipoLiquidacionController::class);

Route::resource('tipo_ausencia', TipoAusenciaController::class);
