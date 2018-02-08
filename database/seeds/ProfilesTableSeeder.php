<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
        [
            'user_id' => 1,
            'age' => '18',
            'location' => 'Portsmouth, UK',
            'bio' => 'Enthusiastic learner with a love for NoBrainer!!',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],
        [
            'user_id' => 2,
            'age' => '19',
            'location' => 'Brighton, UK',
            'bio' => 'I do love a good programmer <3 <3 <3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]
        ]);
    }
}
