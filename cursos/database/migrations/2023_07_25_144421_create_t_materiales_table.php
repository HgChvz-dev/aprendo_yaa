<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_materiales', function (Blueprint $table) {
            $table->id();

            $table->integer('id_clase');
            $table->text('detalle_material');
            $table->date('fecreg_material');
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
        Schema::dropIfExists('t_materiales');
    }
}
