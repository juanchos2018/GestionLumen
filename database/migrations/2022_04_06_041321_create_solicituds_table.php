<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments("id_solicitud");
            $table->string('fecha');
            $table->string('objetivo');
            $table->string('linkdocumento')->nullable();
            $table->string('estado')->nullable();
            $table->string('estado2')->nullable();
            $table->string('mensaje')->nullable();
            $table->string('descripcion')->nullable();


            $table->integer('id_proyecto')->unsigned();
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyectos');

            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
           
            $table->integer('id_jefe')->unsigned();
            $table->foreign('id_jefe')->references('id_usuario')->on('usuarios');
           

            $table->integer('id_fase');
            $table->integer('id_elemento');
            
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
        Schema::dropIfExists('solicituds');
    }
}
