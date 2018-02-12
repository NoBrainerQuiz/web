<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_question_answer')) return;
        
        Schema::create('user_question_answer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('question_id')->unsigned()->index();
            $table->integer('question_choice_id')->unsigned()->index();
            $table->enum('is_right', [0, 1]);
            $table->dateTime('answer_time');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('question_id')
                  ->references('id')
                  ->on('quiz_questions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('question_choice_id')
                  ->references('id')
                  ->on('question_choices')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_question_answer');
    }
}
