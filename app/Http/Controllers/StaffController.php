<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Role;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // Display all staff
    public function index()
    {
        $staffs = Staff::with('role')->orderBy('id', 'desc')->get();
        $all_roles = Role::all();
        return view('admin_librarien', compact('staffs', 'all_roles'));
    }

    // Show edit form
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $all_roles = Role::all();
        return view('staff.edit', compact('staff', 'all_roles'));
    }

    // Store new staff
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'role_id' => 'required|exists:roles,id',
            'department' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'employee_id' => 'nullable|string|unique:staff,employee_id',
            'status' => 'required|in:Active,Inactive,On Leave',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $role = Role::findOrFail($data['role_id']);
        $data['role_name'] = $role->name; // store role name

        $staff = Staff::create($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Staff',
            'details' => "Added Staff: {$staff->name}",
            'status' => 'success'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    // Update staff
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,'.$staff->id,
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'role_id' => 'required|exists:roles,id',
            'department' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'employee_id' => 'nullable|string|unique:staff,employee_id,'.$staff->id,
            'status' => 'required|in:Active,Inactive,On Leave',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $role = Role::findOrFail($data['role_id']);
        $data['role_name'] = $role->name;

        // Track changes for logging
        $changes = [];
        foreach ($data as $key => $value) {
            if ($staff->$key != $value) {
                $changes[] = strtoupper($key) . ": {$staff->$key} → {$value}";
            }
        }

        $staff->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Staff',
            'details' => "Updated Staff: {$staff->name}. Changes: " . implode(', ', $changes),
            'status' => 'success'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully!');
    }

    // Delete staff
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Staff',
            'details' => "Deleted Staff: {$staff->name}",
            'status' => 'success'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
