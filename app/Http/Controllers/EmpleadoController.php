<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Añadimos esta clase para validación

class EmpleadoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo empleado.
     */
    public function create()
    {
        // El controlador simplemente llama a la vista del formulario.
        return view('empleados.create');
    }

    /**
     * Muestra la lista de todos los empleados registrados.
     */
    public function index()
    {
        // 1. Llama al Modelo Empleado para obtener todos los registros.
        $empleados = Empleado::all(); 

        // 2. Retorna la vista y le pasa la colección de empleados.
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Almacena un nuevo empleado en la base de datos (Método futuro).
     */
    public function store(Request $request)
    {
        // PASO 1: VALIDACIÓN DE DATOS
        $request->validate([
            'nombre'            => 'required|string|max:255',
            'id_cedula'         => 'required|string|max:45|unique:EMPLEADO,id_cedula', // Único en la tabla EMPLEADO
            'sexo'              => ['required', 'string', Rule::in(['M', 'F', 'Otro'])], // Usamos 'Otro' por si acaso
            'fecha_nacimiento'  => 'required|date|before:today',
            'lugar_nacimiento'  => 'required|string|max:255',
            'telefono'          => 'required|string|max:11',
            'profesion'         => 'required|string|max:255',
            'direccion'         => 'required|string|max:255',
            'email'             => 'required|email|max:255|unique:EMPLEADO,email', // Único en la tabla EMPLEADO
            'ficha'             => 'required|integer|unique:EMPLEADO,ficha', // Único en la tabla EMPLEADO
            'situacion'         => 'required|string|max:45',
            'salario_base'      => 'required|numeric|min:0',
        ]);

        // PASO 2: CREACIÓN DEL REGISTRO
        // El método create() toma todos los datos validados y los guarda en la base de datos.
        Empleado::create($request->all());

        // PASO 3: REDIRECCIÓN CON MENSAJE
        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado registrado con éxito!');
    }
}