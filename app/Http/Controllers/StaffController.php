<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\MemberCategory;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // Display all staff
    public function index()
    {
        $staffs = Staff::orderBy('id', 'desc')->get();
        $roles = MemberCategory::all();
        return view('admin_librarien', compact('staffs', 'roles'));
    }

    // Store new staff
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'role_id' => 'required|string|exists:membercategory,membercategoryname',
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

        $role = MemberCategory::where('membercategoryname', $request->role_id)->firstOrFail();

        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role_name' => $role->membercategoryname,
            'department' => $request->department,
            'joining_date' => $request->joining_date,
            'employee_id' => $request->employee_id,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
        ]);

        // Optional: Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Staff',
            'details' => "Added Staff: {$staff->name}",
            'status' => 'success'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $roles = MemberCategory::all();
        return view('staff.edit', compact('staff', 'roles'));
    }

    // Update staff
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,'.$staff->id,
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'role_id' => 'required|string',
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

        $role = MemberCategory::where('membercategoryname', $request->role_id)->first();
        if (!$role) {
            return redirect()->back()->withErrors(['role_id' => 'Selected role does not exist']);
        }

        $changes = [];
        foreach ($request->only([
            'name','email','phone','dob','gender','department','joining_date',
            'employee_id','status','address','city','state','zip','country'
        ]) as $key => $value) {
            if ($staff->$key != $value) {
                $changes[] = strtoupper($key) . ": {$staff->$key} → {$value}";
            }
        }

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role_name' => $role->membercategoryname,
            'department' => $request->department,
            'joining_date' => $request->joining_date,
            'employee_id' => $request->employee_id,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
        ]);

        // Optional: Log activity
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

        // Optional: Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Staff',
            'details' => "Deleted Staff: {$staff->name}",
            'status' => 'success'
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
