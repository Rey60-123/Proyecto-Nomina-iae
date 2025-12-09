<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAumento extends Model
{
    // Nombre de la tabla adaptado
    protected $table = 'tipos_aumentos'; 
    // Campos rellenables adaptados: 'tipo' en lugar de 'codigo'
    protected $fillable = ['tipo', 'descripcion'];
}