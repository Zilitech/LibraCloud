<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $librarian = Role::firstOrCreate(['name' => 'Librarian']);

        // Permission list
        $permissions = [
            'dashboard_access',
            'manage_books',
            'issue_return',
            'fine_management',
            'member_management',
            'view_reports'
        ];

        // Create permissions and attach to Admin
        foreach($permissions as $perm){
            $p = Permission::firstOrCreate(['name'=>$perm]);
            $admin->permissions()->syncWithoutDetaching($p->id);
        }

        // Limited permissions for Librarian
        $librarianPerms = ['manage_books','issue_return','view_reports'];
        foreach($librarianPerms as $permName){
            $perm = Permission::where('name', $permName)->first();
            if($perm) $librarian->permissions()->syncWithoutDetaching($perm->id);
        }
    }
}
