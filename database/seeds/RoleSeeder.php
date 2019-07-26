<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],
            [
                'name' => 'User',
                'slug' => 'user'
            ]
        ];
        foreach( $roles as $index => $role){
            Role::firstOrCreate($role);
        }
    }
}
