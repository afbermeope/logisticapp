<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabeceras', function (Blueprint $table) {
            $table->id();
            $table->string('horario');
            $table->integer('cantidad_horas');
            $table->integer('zona_id');
            $table->integer('evento_id');
            $table->integer('cargo_id');
            $table->integer('persona_id');
            $table->integer('tarifa_id');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabeceras');
    }
};
