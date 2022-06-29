<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments("id_material");
            $table->string('cod_material')->unique();
            $table->string('centro')->nullable();
            $table->string('texto')->nullable();

            $table->decimal('precio', 12, 2)->default(0);
            $table->string('moneda')->nullable();

            $table->integer('cantidad')->nullable();
            $table->string('creado')->nullable();
            $table->integer('medida_id')->unsigned();
            $table->foreign('medida_id')->references('medida_id')->on('u_medidas');


            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('grupo_id')->on('grupos');

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
        Schema::dropIfExists('materials');
    }
}
