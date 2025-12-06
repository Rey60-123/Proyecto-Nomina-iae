<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    protected $table = 'tipos_prestamos'; // nombre exacto de la tabla
    protected $fillable = ['codigo', 'descripcion'];
}