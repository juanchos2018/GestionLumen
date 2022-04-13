<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments("id_tarea");
            $table->string('titulo');
            $table->string('descripcion',100);
            $table->string('fecha_inicio');
            $table->string('fecha_termino');
            $table->string('url_evidencia')->nullable();
            $table->string('estado')->nullable();
            $table->string('estado1')->nullable();
            $table->string('estado2')->nullable();
            $table->string('respuesta')->nullable();
            $table->integer('porcentaje')->nullable();

            $table->integer('id_miembro_proyecto')->unsigned();
            $table->foreign('id_miembro_proyecto')->references('id_miembro_proyecto')->on('miembro_proyectos');

            $table->integer('id_version')->unsigned();
            $table->foreign('id_version')->references('id_version')->on('versions');          
       


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
        Schema::dropIfExists('tareas');
    }
}
