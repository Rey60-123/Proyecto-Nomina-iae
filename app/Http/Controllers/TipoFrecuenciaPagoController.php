<?php

namespace App\Http\Controllers;

use App\Models\TipoFrecuenciaPago;
use Illuminate\Http\Request;

class TipoFrecuenciaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frecuenciaPago = TipoFrecuenciaPago::all();

        return view('tipos.show_tipo_frecuencia_pago' , compact('frecuenciaPago'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipos.tipo_frecuencia_pago');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion_frecuencia' => 'required|string|max:100',
        ]);

        TipoFrecuenciaPago::create($request->all());

        return redirect()->route('tipo_frecuencia_pagos.index')
                         ->with('success', '¡frecuencia registrada con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoFrecuenciaPago $tipoFrecuenciaPago)
    {
        return view('tipos.edit_tipo_frecuencia_pago' , compact('tipoFrecuenciaPago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoFrecuenciaPago $tipoFrecuenciaPago)
    {
        $request->validate([
            'descripcion_frecuencia' => 'required|string|max:100|unique:tipo_frecuencia_pagos,descripcion_frecuencia,' . $tipoFrecuenciaPago->id,
        ]);

        // 2. ACTUALIZACIÓN DEL REGISTRO
        $tipoFrecuenciaPago->update($request->all());

        // 3. REDIRECCIÓN
        return redirect()->route('tipo_frecuencia_pagos.index')
                         ->with('success', '¡Frecuencia actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoFrecuenciaPago $tipoFrecuenciaPago)
    {
        // Elimina el registro de la base de datos
        $tipoFrecuenciaPago->delete();
        
        // Redirecciona de vuelta al listado con un mensaje de éxito.
        return redirect()->route('tipo_frecuencia_pagos.index')
                         ->with('success', 'Acumulado eliminado con éxito!');
    }
}
