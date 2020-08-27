<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Claims\Subject;
use Illuminate\Support\Str;

class subjects_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => Str::random(10)
        ]);

        DB::table('subjects')->insert([
            'name' => Str::random(10)
        ]);

        DB::table('subjects')->insert([
            'name' => Str::random(10)
        ]);
    }
}
