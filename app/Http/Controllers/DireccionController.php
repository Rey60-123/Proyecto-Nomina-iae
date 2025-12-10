<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Direcciones;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direcciones::all();
        return view('Niveles Funcionales.direcciones', compact('direcciones'));
    }

    public function create()
    {
        return view('Niveles Funcionales.create_direcciones');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:direcciones,codigo',
            'descripcion' => 'required',
        ]);
        Direcciones::create($request->all());
        return redirect()->route('direcciones.index');
    }

    public function show($id)
    {
        $direccion = Direcciones::findOrFail($id);
        return view('Niveles Funcionales.show_direcciones', compact('direccion'));
    }

    public function edit($id)
    {
        $direccion = Direcciones::findOrFail($id);
        return view('Niveles Funcionales.edit_direcciones', compact('direccion'));
    }

    public function update(Request $request, $id)
    {
        $direccion = Direcciones::findOrFail($id);
        $request->validate([
            'codigo' => 'required|unique:direcciones,codigo,' . $direccion->id,
            'descripcion' => 'required',
        ]);
        $direccion->update($request->all());
        return redirect()->route('direcciones.index');
    }

    public function destroy($id)
    {
        $direccion = Direcciones::findOrFail($id);
        $direccion->delete();
        return redirect()->route('direcciones.index');
    }
}
