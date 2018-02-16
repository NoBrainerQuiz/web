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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // call the seeders
        $this->call([
            UsersTableSeeder::class, 
            QuizzesTableSeeder::class,
            QuestionsTableSeeder::class,
            QuestionsChoicesTableSeeder::class,
            UserQuizzesTableSeeder::class,
            ProfilesTableSeeder::class
        ]);
        // no real need to re-enable checks, as it's only set for the "current" connection
        // but for clarity I've included it.
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
