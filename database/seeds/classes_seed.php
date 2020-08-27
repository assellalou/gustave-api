<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class classes_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'nomination' => Str::random(10),
            'level' => '12'
        ]);

        DB::table('classes')->insert([
            'nomination' => Str::random(10),
            'level' => '9'
        ]);

        DB::table('classes')->insert([
            'nomination' => Str::random(10),
            'level' => '3'
        ]);
    }
}
