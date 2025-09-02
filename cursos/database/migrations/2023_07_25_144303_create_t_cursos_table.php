<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cursos', function (Blueprint $table) {
            $table->id();

            $table->integer('id_creador');
            $table->string('titulo_curso',70);
            $table->string('img_curso',100);
            $table->string('clasifi_curso',20);
            $table->time('tiempo_curso');
            $table->text('descrip_curso');
            $table->string('coprod_curso',80);
            $table->string('tipvalora_curso',25);
            $table->string('vidintro_curso',60);
            $table->string('certifi_curso',60);
            $table->integer('puntaje_curso');
            $table->date('feccrado_curso');
            $table->date('feclanza_curso');
            $table->integer('costo_curso');
            $table->string('linkhm_curso',100);
            $table->string('new_curso',2);
            $table->string('status',);

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
        Schema::dropIfExists('t_cursos');
    }
}
