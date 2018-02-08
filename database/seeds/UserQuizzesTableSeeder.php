<?php

use Illuminate\Database\Seeder;

class UserQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_quizzes')->insert([
        [
            'user_id' => 1,
            'quiz_id' => 1
        ],
        [
            'user_id' => 2,
            'quiz_id' => 2
        ],
        [
            'user_id' => 1,
            'quiz_id' => 3
        ]
        ]);
    }
}
