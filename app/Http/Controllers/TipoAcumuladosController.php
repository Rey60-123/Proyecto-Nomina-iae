<?php

namespace App\Http\Controllers;

use App\Models\TipoAcumulados;
use Illuminate\Http\Request;

class TipoAcumuladosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoAcumulado = TipoAcumulados::all();

        return view('tipos.show_tipo_acumulados' , compact('tipoAcumulado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipos.tipo_acumulados');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion_tipo' => 'required|string|max:20|unique:tipo_acumulados',
            'descripcion_acumulados' => 'required|string|max:100|unique:tipo_acumulados',
        ]);

        TipoAcumulados::create($request->all());

        return redirect()->route('tipo_acumulados.index')
                            ->with('success', '¡Acumulado registrado con éxito!');

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
    public function edit(TipoAcumulados $tipoAcumulado)
    {
        return view('tipos.edit_tipo_acumulados', compact('tipoAcumulado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoAcumulados $tipoAcumulado)
    {
        // 1. VALIDACIÓN
        $request->validate([
            // La regla unique debe ignorar el registro actual para que no falle al guardar sin cambiar la descripción.
            'descripcion_tipo' => 'required|string|max:20|unique:tipo_acumulados,descripcion_tipo,' . $tipoAcumulado->id,
            'descripcion_acumulados' => 'required|string|max:100|unique:tipo_acumulados,descripcion_acumulados,' . $tipoAcumulado->id,
        ]);

        // 2. ACTUALIZACIÓN DEL REGISTRO
        $tipoAcumulado->update($request->all());

        // 3. REDIRECCIÓN
        return redirect()->route('tipo_acumulados.index')
                         ->with('success', '¡Acumulado actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAcumulados $tipoAcumulado)
    {
        // Elimina el registro de la base de datos
        $tipoAcumulado->delete();
        
        // Redirecciona de vuelta al listado con un mensaje de éxito.
        return redirect()->route('tipo_acumulados.index')
                         ->with('success', 'Acumulado eliminado con éxito!');
    }
}
