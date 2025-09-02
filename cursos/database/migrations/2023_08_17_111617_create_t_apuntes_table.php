<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTApuntesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_apuntes', function (Blueprint $table) {
            $table->id();

            $table->integer('id_alumno');
            $table->integer('id_clase');
            $table->text('apunte_apunte');
            $table->date('fecha_apunte');
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
        Schema::dropIfExists('t_apuntes');
    }
}
