<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\MemberCategory;

class StaffController extends Controller
{
    // Display all staff
    public function index()
    {
        $staffs = Staff::orderBy('id', 'desc')->get(); // role_id not needed
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
            'role_id' => 'required|string|exists:membercategory,membercategoryname', // validate by name
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

        // Fetch the role by name
        $role = MemberCategory::where('membercategoryname', $request->role_id)->firstOrFail();

        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role_name' => $role->membercategoryname, // store role name
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
        'role_id' => 'required|string', // just string
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

    return redirect()->route('staff.index')->with('success', 'Staff updated successfully!');
}

    // Delete staff
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
