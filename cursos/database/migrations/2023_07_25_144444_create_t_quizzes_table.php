<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_quizzes', function (Blueprint $table) {
            $table->id();

            $table->integer('id_clase');
            $table->string('pregu_quiz',170);
            $table->string('respa_quiz',120);
            $table->string('respb_quiz',120);
            $table->string('respc_quiz',120);
            $table->string('respd_quiz',120);
            $table->string('corre_quiz',1);
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
        Schema::dropIfExists('t_quizzes');
    }
}
