<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
  
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments("idprov");
            $table->string('cod_prov')->unique();
            $table->string('prov_razon_social')->nullable();
            $table->string('prov_telefono')->nullable();
            $table->string('prov_email')->nullable();
            $table->integer('prov_status')->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}
