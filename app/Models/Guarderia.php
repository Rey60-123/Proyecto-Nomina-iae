<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarderia extends Model
{
    protected $table = 'guarderias'; 
    
    // Todos los campos adaptados de la migración
    protected $fillable = [
        'codigo_guarderia',
        'sucursal_ubicacion',
        'rif',
        'nombre',
        'direccion',
        'telefonos',
        'nro_registro',
        'monto_inscripcion_base',
        'monto_mensual_base',
    ];
}