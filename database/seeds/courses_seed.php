<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class courses_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => Str::random(15),
            'subject' => 3,
            'chapter' => Str::random(20),
            'link' => 'http://' . Str::random(10) . '.com/' . Str::random(20),
            'teacher' => 1,
            'classe' => 1
        ]);

        DB::table('courses')->insert([
            'name' => Str::random(15),
            'subject' => 3,
            'chapter' => Str::random(20),
            'link' => 'http://' . Str::random(10) . '.com/' . Str::random(20),
            'teacher' => 1,
            'classe' => 1
        ]);

        DB::table('courses')->insert([
            'name' => Str::random(15),
            'subject' => 3,
            'chapter' => Str::random(20),
            'link' => 'http://' . Str::random(10) . '.com/' . Str::random(20),
            'teacher' => 1,
            'classe' => 3
        ]);
    }
}
