<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    // Load the page with all roles and their permissions
    public function index()
    {
        $roles = Role::with('permissions')->get(); // fetch roles with permissions
        return view('roles_permission', compact('roles')); // pass $roles to Blade
    }

    // Store a new role along with permissions
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|unique:roles,name',
            'permissions' => 'array' // optional
        ]);

        // 1️⃣ Create the Role
        $role = Role::create(['name' => $request->role_name]);

        // 2️⃣ Attach Permissions
        $attachedPermissions = [];
        if ($request->has('permissions')) {
            $permissionIds = [];
            foreach ($request->permissions as $permName) {
                // Create permission if it doesn't exist
                $permission = Permission::firstOrCreate(['name' => $permName]);
                $permissionIds[] = $permission->id;
                $attachedPermissions[] = $permission->name;
            }

            // Attach all permissions to role in pivot table without duplicates
            $role->permissions()->sync($permissionIds);
        }

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Create Role',
            'details' => "Created role '{$role->name}' with permissions: " . implode(', ', $attachedPermissions),
            'status'  => 'success'
        ]);

        return redirect()->back()->with('success', 'Role and permissions added successfully!');
    }

    // Delete a role
    public function destroy(Role $role)
    {
        $roleName = $role->name;
        $permissions = $role->permissions->pluck('name')->toArray();

        // Detach all permissions first (optional, but recommended)
        $role->permissions()->detach();

        // Delete the role
        $role->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Role',
            'details' => "Deleted role '{$roleName}' with permissions: " . implode(', ', $permissions),
            'status'  => 'success'
        ]);

        return redirect()->back()->with('success', 'Role deleted successfully!');
    }
}
