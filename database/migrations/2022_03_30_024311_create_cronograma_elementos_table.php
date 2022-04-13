<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramaElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronograma_elementos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id_cronograma_elemento');
            $table->integer('id_elemento');
            $table->string('nombre_elemento');
            $table->integer('id_cronograma')->unsigned();
            $table->foreign('id_cronograma')->references('id_cronograma')->on('cronogramas');
            $table->integer('id_cronograma_fase')->unsigned();
            $table->foreign('id_cronograma_fase')->references('id_cronograma_fase')->on('cronograma_fases');

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
        Schema::dropIfExists('cronograma_elementos');
    }
}
