<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_questions')->insert([
        [
            'quiz_id' => 1,
            'question' => 'Which one of these isn\'t a data structure?'
        ],
        [
            'quiz_id' => 2,
            'question' => 'Which one of the following is a set of natural numbers?'
        ],
        [
            'quiz_id' => 3,
            'question' => 'Which one of the following is a colour of the rainbow?'
        ]
        ]);
    }
}
