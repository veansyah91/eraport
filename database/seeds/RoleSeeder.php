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
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'teacher',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'home room teacher',
            'guard_name' => 'web'
        ]);
    }
}
