<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_aportes', function (Blueprint $table) {
            $table->id();

            $table->integer('id_curso');
            $table->integer('id_alumno');
            $table->string('detalle_aporte',250);
            $table->date('fecha_aporte');
            $table->string('status',10);

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
        Schema::dropIfExists('t_aportes');
    }
}
