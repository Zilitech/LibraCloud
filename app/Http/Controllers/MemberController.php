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

    public function edit(Member $member)
{
    $membercategories = DB::table('membercategory')->get();

    return view('members.edit_member', compact('member', 'membercategories'));
}

public function update(Request $request, Member $member)
{
    $request->validate([
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

    // Create type if new (like category/author creation)
    if ($request->filled('membertype')) {
        DB::table('membercategory')->updateOrInsert(
            ['membercategoryname' => $request->membertype]
        );
    }

    // collect updatable fields
    $data = $request->only([
        'memberid','fullname','gender','dateofbirth','membertype','departmentclass',
        'rollnoemployeeid','yearsemester','email','phone','address','city','state',
        'pincode','joiningdate','status'
    ]);

    // checkbox
    $data['cardIssued'] = $request->has('cardIssued');

    // photo upload
    if ($request->hasFile('profilephoto')) {

        if ($member->profilephoto && file_exists(public_path('profile_photos/' . $member->profilephoto))) {
            unlink(public_path('profile_photos/' . $member->profilephoto));
        }

        $imageName = time() . '_member.' . $request->profilephoto->extension();
        $request->profilephoto->move(public_path('profile_photos'), $imageName);
        $data['profilephoto'] = $imageName;
    }

    // update
    $member->update($data);

    return redirect()->route('member.show')->with('success', 'Member updated successfully!');
}




    public function show()
    {
        $members = Member::orderBy('created_at', 'desc')->get();
        $membercategories = DB::table('membercategory')->get();
        return view('all_member', compact('members', 'membercategories'));
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // Delete profile photo if exists
        if ($member->profilephoto && file_exists(public_path('profile_photos/' . $member->profilephoto))) {
            unlink(public_path('profile_photos/' . $member->profilephoto));
        }

        $member->delete();

        return back()->with('success', 'Member deleted successfully!');
    }

    public function index(Request $request)
{
    $query = Member::query();

    // --- Search ---
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('fullname', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%")
              ->orWhere('memberid', 'LIKE', "%$search%");
        });
    }

    // --- Filter ---
    if ($request->filter && $request->filter !== 'All') {
        if (in_array($request->filter, ['Active', 'Inactive'])) {
            $query->where('status', $request->filter);
        } else {
            $query->where('membertype', $request->filter);
        }
    }

    $members = $query->orderBy('id', 'DESC')->paginate(10);

    // Fetch categories for dropdown
    $membercategories = DB::table('membercategory')->get();

    return view('all_member', compact('members', 'membercategories'));
}





}
