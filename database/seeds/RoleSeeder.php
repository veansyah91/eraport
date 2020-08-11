<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'ADMIN',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'GURU',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'WALIKELAS',
            'guard_name' => 'web'
        ]);
    }
}
