<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'empleado'; 

    // Clave primaria
    protected $primaryKey = 'id_empleado'; 

    // Campos que se pueden asignar masivamente (para cuando implementes el método store)
    protected $fillable = [
        'nombre', 'id_cedula', 'sexo', 'fecha_nacimiento', 'lugar_nacimiento', 
        'telefono', 'profesion', 'direccion', 'email', 'ficha', 'situacion', 'salario_base'
    ];
    
    // Indicamos que no usamos las marcas de tiempo por defecto (created_at, updated_at)
    // Si tu tabla no las tiene, debes incluir esta línea:
    public $timestamps = false; 
}