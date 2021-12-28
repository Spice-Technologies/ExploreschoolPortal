<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class permissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         // Permission::create(['name' => 'edit articles']);
         $role = Role::create(['name' => 'SuperAdmin']);
         $roleAdmin = Role::create(['name' => 'Admin']);
         $role = Role::create(['name' => 'Teacher']);
         $role = Role::create(['name' => 'Parent']);
         $roleStudent = Role::create(['name' => 'Student']);

         Permission::create(['name' => 'Manage School']);
        Permission::create(['name' => 'See School Info']);
   
            // create roles and assign existing permissions
        $roleAdmin->givePermissionTo('Manage School');
        $roleStudent->givePermissionTo('See School Info');
    }
}
