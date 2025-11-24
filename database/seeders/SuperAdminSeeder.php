<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Make sure this is your User model
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Permissions
        $permissions = [
            'dashboard_access',
            'book_management_access',
            'add_book',
            'category_management',
            'author_management',
            'inventory_management',
            'barcode_scan',
            'barcode_generate',
            'member_management',
            'add_member',
            'membership_card',
            'issue_book',
            'return_book',
            'overdue_management',
            'fine_management',
            'notifications_access',
            'due_date_alerts',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2. Create Super Admin Role
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // 3. Assign All Permissions to Super Admin Role
        $superAdminRole->syncPermissions(Permission::all());

        // 4. Assign Role to a User (first user)
        $user = User::first(); // Change to the specific user ID if needed
        if ($user) {
            $user->assignRole('super_admin');
        }

        $this->command->info('Super Admin role and permissions created successfully!');
    }
}
