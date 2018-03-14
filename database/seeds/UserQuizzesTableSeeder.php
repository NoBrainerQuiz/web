<?php

use Illuminate\Database\Seeder;

class UserQuizzesTableSeeder extends Seeder
{
    private $table = 'user_quizzes';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
        DB::table($this->table)->insert([
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
        ],
        [
            'user_id' => 1,
            'quiz_id' => 4
        ]
        ]);
    }
}
