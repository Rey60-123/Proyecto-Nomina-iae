<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index()
    {
        $presupuestos = Presupuesto::all();
        return view('Niveles Funcionales.presupuesto', compact('presupuestos'));
    }

    public function create()
    {
        return view('Niveles Funcionales.create_presupuesto');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
        ]);

        Presupuesto::create($request->all());

        return redirect()->route('presupuesto.index')->with('success', 'Presupuesto creado correctamente.');
    }

    public function show($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('Niveles Funcionales.show_presupuesto', compact('presupuesto'));
    }

    public function edit($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('Niveles Funcionales.edit_presupuesto', compact('presupuesto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
        ]);

        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->update($request->all());

        return redirect()->route('presupuesto.index')->with('success', 'Presupuesto actualizado correctamente.');
    }

    public function destroy($id)
    {
        Presupuesto::findOrFail($id)->delete();

        return redirect()->route('presupuesto.index')->with('success', 'Presupuesto eliminado.');
    }
}
