<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposPrestamosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_prestamos', function (Blueprint $table) {
            $table->id(); // id
            $table->string('codigo', 50); // código
            $table->string('descripcion', 255); // descripción
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_prestamos');
    }
}

