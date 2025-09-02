<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_clases', function (Blueprint $table) {
            $table->id();

            $table->integer('id_curso');
            $table->string('titulo_clase',70);
            $table->text('detalle_clase');
            $table->string('clasifi_clase',20);
            $table->time('timedura_clase');
            $table->string('imgchiqui_clase',100);
            $table->string('imggrand_clase',100);
            $table->string('genero_clase',25);
            $table->string('repasovid_clase',100);
            $table->string('clasevid_clase',100);
            $table->integer('ptaprueba_clase');
            $table->date('feccrea_clase');
            $table->date('feclanza_clase');
            $table->integer('cantpreg_clase');
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
        Schema::dropIfExists('t_clases');
    }
}
