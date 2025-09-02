<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_recursos', function (Blueprint $table) {
            $table->id();

            $table->integer('id_clase');
            $table->string('titulo_recurso',100);
            $table->string('archivos_recurso',100);
            $table->date('fecreg_recurso');
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
        Schema::dropIfExists('t_recursos');
    }
}
