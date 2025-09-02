<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCreadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_creadors', function (Blueprint $table) {
            $table->id();

            $table->integer('id_pais');
            $table->string('nomemp_creador',60);
            $table->string('icono_creador',100);
            $table->string('img_creador',100);
            $table->string('logo_creador',100);
            $table->string('titemp_creador',70);
            $table->string('siglas_creador',20);
            $table->string('genero_creador',60);
            $table->string('email_creador',100);
            $table->string('clave_creador',100);
            $table->date('fecsus_creador');
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
        Schema::dropIfExists('t_creadors');
    }
}
