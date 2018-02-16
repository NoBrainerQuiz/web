<?php

use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    private $table = 'quizzes';
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
            'quiz_name' => 'Data Structures & Algorithms',
            'quiz_description' => 'This is a quiz to test your knowledge on Data Structures & Algorithms',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],
        [
            'quiz_name' => 'Discrete Mathematics & Functional Programmimg',
            'quiz_description' => 'This is a quiz to test your knowledge on Discrete Mathematics & Functional Programming',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],
        [
            'quiz_name' => 'Colours of the rainbow',
            'quiz_description' => 'Fancy a challenge? Then test your knowhow on the colours of the rainbow',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]
        ]);
    }
}
