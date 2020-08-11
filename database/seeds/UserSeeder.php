<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'veansyah91@gmail.com',
            'password' => Hash::make('9968Siskom'),
            'status' => 'admin'
        ]);

        $user->assignRole('SUPER ADMIN');
    }
}
