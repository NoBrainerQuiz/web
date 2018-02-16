<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $table = 'users';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
         // insert some test user accounts
         DB::table($this->table)->insert([
         [
             'username' => 'quiz_user',
             'email'    => 'quiz_user@nobrainerquiz.com',
             'password' => bcrypt('secret'),
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s')
         ],
         [
            'username' => 'quiz_host',
            'email'    => 'quiz_host@nobrainerquiz.com',
            'password' => bcrypt('secret'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
         ]
        ]);
    }
}
