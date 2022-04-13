<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments("id_version");
            $table->string('version');
            $table->string('fecha_inicio');
            $table->string('fecha_termino');

            $table->integer('id_cronograma_elemento')->unsigned();
            $table->foreign('id_cronograma_elemento')->references('id_cronograma_elemento')->on('cronograma_elementos');

            $table->integer('id_miembro_proyecto')->unsigned();
            $table->foreign('id_miembro_proyecto')->references('id_miembro_proyecto')->on('miembro_proyectos');
       


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
        Schema::dropIfExists('versions');
    }
}
