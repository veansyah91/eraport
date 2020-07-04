<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'veansyah91@gmail.com',
            'password' => Hash::make('9968Siskom'),
            'status' => 'admin'
        ]);
    }
}
