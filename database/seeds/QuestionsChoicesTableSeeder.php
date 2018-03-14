<?php

use Illuminate\Database\Seeder;

class QuestionsChoicesTableSeeder extends Seeder
{
    private $table = 'question_choices';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
        DB::table($this->table)->insert([
            // Choices for question 1
        [
            'question_id' => 1,
            'is_right_choice' => '0',
            'choice' => 'A pineapple tree with cucumbers'
        ],
        [
            'question_id' => 1,
            'is_right_choice' => '1', // this is the right choice (enum = 1 = true, enum = 0 = false)
            'choice' => 'A binary search tree'
        ],
        [
            'question_id' => 1,
            'is_right_choice' => '0',
            'choice' => 'A church choir'
        ],
        [
            'question_id' => 1,
            'is_right_choice' => '0',
            'choice' => 'A logarithmic skip line'
        ],
            // Choices for question 2
        [
            'question_id' => 2,
            'is_right_choice' => '0',
            'choice' => '{A, B, C, D, E, F, G}'
        ],
        [
            'question_id' => 2,
            'is_right_choice' => '0',
            'choice' => '{{1, 0.5, 18, 2.2, 1.8, 89, 45}, 2, 4, 8}'
        ],
        [
            'question_id' => 2,
            'is_right_choice' => '0',
            'choice' => '{-1, -2, -3, {-8, -12, -89}, 2, 1}'
        ],
        [
            'question_id' => 2,
            'is_right_choice' => '1', // this is the right answer again (hi)
            'choice' => '{1, 34, 56, {50, 67, 123, 978}, 54, 12, 17}'
        ],
            // Choices for question 3
        [
            'question_id' => 3,
            'is_right_choice' => '1', // this is also right answer...last time
            'choice' => 'Violet'
        ],
        [
            'question_id' => 3,
            'is_right_choice' => '0',
            'choice' => 'Cheeky Cherry'
        ],
        [
            'question_id' => 3,
            'is_right_choice' => '0',
            'choice' => 'Racing Green'
        ],
        [
            'question_id' => 3,
            'is_right_choice' => '0',
            'choice' => 'Saucy Strawberry'
        ],
        // Choices for question 4
        [
            'question_id' => 4,
            'is_right_choice' => '1', // this is also right answer...last time
            'choice' => 'Hopefully'
        ],
        [
            'question_id' => 4,
            'is_right_choice' => '0',
            'choice' => 'No'
        ],
        [
            'question_id' => 4,
            'is_right_choice' => '0',
            'choice' => 'A million percent yes!'
        ],
        [
            'question_id' => 4,
            'is_right_choice' => '0',
            'choice' => 'Who knows?'
        ],
        // Choices for question 5
        [
            'question_id' => 5,
            'is_right_choice' => '0', // this is also right answer...last time
            'choice' => '2010'
        ],
        [
            'question_id' => 5,
            'is_right_choice' => '0',
            'choice' => '2012'
        ],
        [
            'question_id' => 5,
            'is_right_choice' => '1',
            'choice' => '2008'
        ],
        [
            'question_id' => 5,
            'is_right_choice' => '0',
            'choice' => '2003'
        ],
        // Choices for question 6
        [
            'question_id' => 6,
            'is_right_choice' => '0', // this is also right answer...last time
            'choice' => 'No'
        ],
        [
            'question_id' => 6,
            'is_right_choice' => '0',
            'choice' => 'Whats even is No-brainer?'
        ],
        [
            'question_id' => 6,
            'is_right_choice' => '0',
            'choice' => 'Possibly'
        ],
        [
            'question_id' => 6,
            'is_right_choice' => '1',
            'choice' => 'Yes'
        ]
        ]);
    }
}
