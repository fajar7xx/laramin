<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'fajar siagian',
            'email' => 'fajar7xx@gmail.com',
            'password' => Hash::make('azhari30'),
            'roles' => json_encode(['customer']),
            'status' => 'active'
        ]);
    }
}
