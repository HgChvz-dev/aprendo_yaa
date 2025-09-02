<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_results', function (Blueprint $table) {
            $table->id();

            $table->integer('id_alumno');
            $table->integer('id_curso');
            $table->text('rp1_result');
            $table->text('rp2_result');
            $table->text('rp3_result');
            $table->text('rp4_result');
            $table->text('rp5_result');
            $table->text('rp6_result');
            $table->text('rp7_result');
            $table->text('rp8_result');
            $table->text('rp9_result');
            $table->text('rp10_result');
            $table->text('promedio_result');
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
        Schema::dropIfExists('t_results');
    }
}
