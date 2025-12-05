<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoFrecuenciaPago extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'tipo_frecuencia_pagos'; 

    // Clave primaria
    protected $primaryKey = 'id'; 

    // Campos que se pueden asignar masivamente (para cuando implementes el método store)
    protected $fillable = [
        'descripcion_frecuencia'
    ];
    
    // Indicamos que no usamos las marcas de tiempo por defecto (created_at, updated_at)
    // Si tu tabla no las tiene, debes incluir esta línea:
    //public $timestamps = false; 
}
