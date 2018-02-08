<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // call the seeders
        $this->call([
            UsersTableSeeder::class, 
            QuizzesTableSeeder::class,
            QuestionsTableSeeder::class,
            QuestionsChoicesTableSeeder::class,
            UserQuizzesTableSeeder::class,
            ProfilesTableSeeder::class
        ]);
    }
}
