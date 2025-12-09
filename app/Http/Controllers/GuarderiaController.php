<?php

namespace App\Http\Controllers;

use App\Models\Guarderia; 
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GuarderiaController extends Controller
{
    public function index()
    {
        $guarderias = Guarderia::all();
        // Usamos la vista 'tipos.Guarderias'
        return view('tipos.Guarderias', compact('guarderias'));
    }

    public function create()
    {
        // Usamos la vista 'tipos.create_Guarderias'
        return view('tipos.create_Guarderias');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_guarderia' => 'required|max:50|unique:guarderias,codigo_guarderia',
            'nombre' => 'required|max:255',
            'monto_inscripcion_base' => 'required|numeric|min:0',
            'monto_mensual_base' => 'required|numeric|min:0',
            // Otras validaciones opcionales
        ]);

        Guarderia::create($request->all());

        // Usamos la ruta adaptada 'guarderias.index'
        return redirect()->route('Guarderias.index')->with('success', 'Guardería agregada exitosamente.');
    }

    public function edit($id)
    {
        $guarderia = Guarderia::findOrFail($id);
        // Usamos la vista 'tipos.edit_Guarderias'
        return view('tipos.edit_Guarderias', compact('guarderia'));
    }

    public function update(Request $request, $id)
    {
        $guarderia = Guarderia::findOrFail($id);
        
        $request->validate([
            'codigo_guarderia' => 'required|max:50|unique:guarderias,codigo_guarderia,' . $id,
            'nombre' => 'required|max:255',
            'monto_inscripcion_base' => 'required|numeric|min:0',
            'monto_mensual_base' => 'required|numeric|min:0',
        ]);
        
        $guarderia->update($request->all());

        return redirect()->route('Guarderias.index')
                         ->with('success', 'Guardería actualizada correctamente');
    }

    public function destroy($id) 
    {
        $guarderia = Guarderia::find($id);

        if (!$guarderia) {
            return redirect()->route('Guarderias.index')
                             ->with('error', 'El registro que intentas eliminar ya no existe.');
        }
        
        try {
            $guarderia->delete();
            
            return redirect()->route('Guarderias.index')
                             ->with('success', 'La Guardería fue eliminada exitosamente.');

        } catch (QueryException $e) {
            return redirect()->route('Guarderias.index')
                             ->with('error', '🚫 No se puede eliminar esta Guardería. Está asociada a otros registros.');
            
        } catch (\Exception $e) {
            return redirect()->route('Guarderias.index')
                             ->with('error', 'Ocurrió un error inesperado al intentar eliminar el registro.');
        }
    }
}