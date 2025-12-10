<?php

// app/Http/Controllers/DepartamentoController.php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('Niveles Funcionales.departamentos', compact('departamentos'));
    }

    public function create()
    {
        return view('Niveles Funcionales.create_departamentos');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:departamentos,codigo',
            'descripcion' => 'required',
        ]);

        Departamento::create($request->all());
        return redirect()->route('departamentos.index');
    }

    public function show(Departamento $departamento)
    {
        return view('Niveles Funcionales.show_departamentos', compact('departamento'));
    }

    public function edit(Departamento $departamento)
    {
        return view('Niveles Funcionales.edit_departamentos', compact('departamento'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'codigo' => 'required|unique:departamentos,codigo,' . $departamento->id,
            'descripcion' => 'required',
        ]);

        $departamento->update($request->all());
        return redirect()->route('departamentos.index');
    }

    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        return redirect()->route('departamentos.index');
    }
}
