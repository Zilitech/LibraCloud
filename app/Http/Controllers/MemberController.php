<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function create()
    {
        $membercategories = DB::table('membercategory')->get();
        return view('add_member', compact('membercategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'memberid'          => 'nullable|string|max:255',
            'fullname'          => 'required|string|max:255',
            'gender'            => 'nullable|string|max:20',
            'dateofbirth'       => 'nullable|date',
            'membertype'        => 'nullable|string|max:50',
            'departmentclass'   => 'nullable|string|max:255',
            'rollnoemployeeid'  => 'nullable|string|max:255',
            'yearsemester'      => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'address'           => 'nullable|string',
            'city'              => 'nullable|string|max:255',
            'state'             => 'nullable|string|max:255',
            'pincode'           => 'nullable|string|max:20',
            'joiningdate'       => 'nullable|date',
            'status'            => 'required|string|max:20',
            'profilephoto'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cardIssued'        => 'nullable|boolean',
        ]);

        // Upload profile photo
        if ($request->hasFile('profilephoto')) {
            $file = $request->file('profilephoto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_photos'), $filename);
            $validated['profilephoto'] = $filename;
        }

        // Create the Member using Model
        Member::create($validated);

        return back()->with('success', 'Member added successfully!');
    }



    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt|max:2048',
    ]);

    $file = fopen($request->file('csv_file')->getRealPath(), 'r');
    $header = fgetcsv($file); // Skip first row

    while (($row = fgetcsv($file)) !== false) {

        // Convert blank values to null
        $row = array_map(function ($value) {
            return $value !== "" ? $value : null;
        }, $row);

Member::create([
    'memberid'          => $row[0] ?? null,
    'fullname'          => $row[1] ?? null,
    'gender'            => $row[2] ?? null,
    'dateofbirth'       => !empty($row[3]) ? date('Y-m-d', strtotime($row[3])) : null,
    'membertype'        => $row[4] ?? null,
    'departmentclass'   => $row[5] ?? null,
    'rollnoemployeeid'  => $row[6] ?? null,
    'yearsemester'      => $row[7] ?? null,
    'email'             => $row[8] ?? null,
    'phone'             => $row[9] ?? null,
    'address'           => $row[10] ?? null,
    'city'              => $row[11] ?? null,
    'state'             => $row[12] ?? null,
    'pincode'           => $row[13] ?? null,
    'joiningdate'       => !empty($row[14]) ? date('Y-m-d', strtotime($row[14])) : null,

    // FIXED (status cannot be null)
    'status'            => !empty($row[15]) ? $row[15] : 'Active',

    'profilephoto'      => $row[16] ?? null,
    'cardIssued'        => $row[17] ?? 0,
]);

    }

    fclose($file);

    return back()->with('success', 'CSV imported successfully!');
}

}
