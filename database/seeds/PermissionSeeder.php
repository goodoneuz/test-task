<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'View all orders'
            ],
            [
                'name' => 'Moderate all orders'
            ],
            [
                'name' => 'Edit all orders'
            ],
            [
                'name' => 'Delete all orders'
            ]
        ];
        foreach( $permissions as $index => $permission){
            Permission::firstOrCreate($permission);
        }
    }
}
