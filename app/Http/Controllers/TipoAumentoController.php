<?php

namespace App\Http\Controllers;

use App\Models\TipoAumento; // Usamos el nuevo modelo
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TipoAumentoController extends Controller
{
    public function index()
    {
        $tiposAumento = TipoAumento::all();
        // Usamos la vista solicitada 'tipos.tipos_Aumentos'
        return view('tipos.tipos_Aumentos', compact('tiposAumento'));
    }

    public function create()
    {
        // Usamos la vista solicitada 'tipos.create_tipos_Aumentos'
        return view('tipos.create_tipos_Aumentos');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|max:50|unique:tipos_aumentos,tipo', // Validamos el campo 'tipo'
            'descripcion' => 'required|max:255',
        ]);

        TipoAumento::create($request->all());

        // Usamos la ruta adaptada 'tipos_aumentos.index'
        return redirect()->route('tipo_Aumentos.index')->with('success', 'Tipo de Aumento agregado.');
    }

    public function edit($id)
    {
        $tipoAumento = TipoAumento::findOrFail($id);
        // Usamos la vista solicitada 'tipos.edit_tipos_Aumentos' y pasamos $tipoAumento
        return view('tipos.edit_tipos_Aumentos', compact('tipoAumento'));
    }

    public function update(Request $request, $id)
    {
        $tipoAumento = TipoAumento::findOrFail($id);
        
        $request->validate([
            'tipo' => 'required|max:50|unique:tipos_aumentos,tipo,' . $id, // Validamos unicidad, excluyendo el ID actual
            'descripcion' => 'required|max:255',
        ]);
        
        $tipoAumento->update($request->all());

        // Usamos la ruta adaptada 'tipos_aumentos.index'
        return redirect()->route('tipos_Aumentos.index')
                         ->with('success', 'Tipo de Aumento actualizado correctamente');
    }

    public function destroy($id) 
    {
        $tipoAumento = TipoAumento::find($id);

        if (!$tipoAumento) {
            return redirect()->route('tipos_Aumentos.index')
                             ->with('error', 'El registro que intentas eliminar ya no existe o fue movido.');
        }
        
        try {
            $tipoAumento->delete();
            
            return redirect()->route('tipos_Aumentos.index')
                             ->with('success', 'El tipo de aumento fue eliminado exitosamente.');

        } catch (QueryException $e) {
            // Manejo de error de clave foránea
            return redirect()->route('tipos_Aumentos.index')
                             ->with('error', '🚫 No se puede eliminar este tipo de aumento. Está asociado a otros registros.');
            
        } catch (\Exception $e) {
            return redirect()->route('tipos_Aumentos.index')
                             ->with('error', 'Ocurrió un error inesperado al intentar eliminar el registro.');
        }
    }
}