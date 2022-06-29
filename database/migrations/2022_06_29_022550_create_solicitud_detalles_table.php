<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments("solicitud_id");
            $table->string('fecha')->nullable();
            $table->string('usuario')->nullable();
            $table->string('cantidad')->nullable();
            $table->timestamps();
        });

        Schema::create('solicitud_detalles', function (Blueprint $table) {
            $table->increments("detalle_id");

            $table->integer('cantidad');
            $table->integer('status');
            $table->date('fecha')->nullable();
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('solicitud_id')->on('solicitudes');


            $table->integer('id_material')->unsigned();
            $table->foreign('id_material')->references('id_material')->on('materials');

            $table->integer('solicitante_id')->unsigned();
            $table->foreign('solicitante_id')->references('solicitante_id')->on('solicitantes');

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
        Schema::dropIfExists('solicitud_detalles');
    }
}
