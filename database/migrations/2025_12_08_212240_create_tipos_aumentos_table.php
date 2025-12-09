<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposAumentosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_aumentos', function (Blueprint $table) {
            $table->id(); 
            // Cambiamos 'codigo' por 'tipo' para coincidir con la interfaz solicitada
            $table->string('tipo', 50)->unique(); 
            $table->string('descripcion', 255); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_aumentos');
    }
}