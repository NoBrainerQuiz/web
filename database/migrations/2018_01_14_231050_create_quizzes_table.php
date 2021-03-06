<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('quizzes')) return;
        
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quiz_name', 80);
            $table->text('quiz_description');
            $table->string('quiz_pin');
            $table->enum('active', [0, 1])->nullable();
            $table->bigInteger('total_plays')->nullable();
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
        Schema::dropIfExists('quizzes');
    }
}
