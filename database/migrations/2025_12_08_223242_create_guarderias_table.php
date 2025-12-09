<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarderiasTable extends Migration
{
    public function up()
    {
        Schema::create('guarderias', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo_guarderia', 50)->unique();
            $table->string('sucursal_ubicacion', 100)->nullable();
            $table->string('rif', 50)->nullable();
            $table->string('nombre', 255);
            $table->string('direccion', 500)->nullable();
            $table->string('telefonos', 100)->nullable();
            $table->string('nro_registro', 100)->nullable();
            // Campos monetarios
            $table->decimal('monto_inscripcion_base', 10, 2)->default(0.00);
            $table->decimal('monto_mensual_base', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guarderias');
    }
}