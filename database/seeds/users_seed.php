<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class users_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10) . ' ' . Str::random(7),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'teacher',
            'is_teacher' => true,
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10) . ' ' . Str::random(7),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'admin',
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10) . ' ' . Str::random(7),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'student',
        ]);
    }
}
