<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $admin = Role::create(['name' => 'Admin']);
        $librarian = Role::create(['name' => 'Librarian']);

        // Permissions list
        $permissions = [
            'manage_books','manage_categories','manage_authors','manage_inventory',
            'issue_return','manage_members','view_reports','fine_management',
            'library_settings','user_management','barcode_management','ebook_management'
        ];

        // Create permissions and assign to Admin
        foreach($permissions as $perm){
            $p = Permission::create(['name'=>$perm]);
            $admin->permissions()->attach($p->id);
        }

        // Assign limited permissions to Librarian
        $librarian->permissions()->attach(
            Permission::whereIn('name',['manage_books','issue_return','view_reports'])->pluck('id')
        );
    }
}
