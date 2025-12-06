<?php

namespace App\Http\Controllers;

use App\Models\TipoPrestamo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TipoPrestamoController extends Controller
{
    public function index()
    {
        $tipos = TipoPrestamo::all();
        return view('tipos.tipo_prestamos', compact('tipos'));
    }

    public function create()
    {
        return view('tipos.create_tipo_prestamos');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|max:50',
            'descripcion' => 'required|max:255',
        ]);

        TipoPrestamo::create($request->all());

        return redirect()->route('tipo_prestamos.index')->with('success', 'Tipo de préstamo agregado.');
    }

    

    public function edit($id)
{
    $tipo = TipoPrestamo::findOrFail($id);
    return view('tipos.edit_tipo_prestamos', compact('tipo'));
}

public function update(Request $request, $id)
{
    $tipo = TipoPrestamo::findOrFail($id);
    $tipo->update($request->all());

    return redirect()->route('tipo_prestamos.index')
                     ->with('success', 'Tipo de préstamo actualizado correctamente');
        }
       


// Modificamos la firma para aceptar el ID en lugar del modelo
public function destroy($id) 
{
    // 1. Intentar encontrar el registro por ID
    $tipo = TipoPrestamo::find($id);

    // 2. Verificar si el registro fue encontrado
    if (!$tipo) {
        return redirect()->route('tipo_prestamos.index')
                         ->with('error', 'El registro que intentas eliminar ya no existe o fue movido.');
    }
    
    // 3. Ejecutar la lógica de eliminación y manejo de errores
    try {
        $tipo->delete();
        
        return redirect()->route('tipo_prestamos.index')
                         ->with('success', 'El tipo de préstamo fue eliminado exitosamente.');

    } catch (QueryException $e) {
        // Manejo de error de clave foránea
        return redirect()->route('tipo_prestamos.index')
                         ->with('error', '🚫 No se puede eliminar este tipo de préstamo. Está asociado a otros préstamos.');
        
    } catch (\Exception $e) {
        return redirect()->route('tipo_prestamos.index')
                         ->with('error', 'Ocurrió un error inesperado al intentar eliminar el registro.');
    }
}
}
