<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // insert some test user accounts
         DB::table('users')->insert([
             'username' => 'quiz_user',
             'email'    => 'quiz_user@nobrainerquiz.com',
             'password' => bcrypt('secret')
         ],
         [
            'username' => 'quiz_host',
            'email'    => 'quiz_host@nobrainerquiz.com',
            'password' => bcrypt('secret')
        ]);
    }
}
