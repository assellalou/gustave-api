<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(users_seed::class);
        $this->call(subjects_seed::class);
        $this->call(classes_seed::class);
        $this->call(courses_seed::class);
    }
}
