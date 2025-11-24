<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

        $member = Member::create($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Add Member',
            'details' => "Added Member: {$member->fullname} (ID: {$member->id})",
            'status'  => 'success',
        ]);

        return back()->with('success', 'Member added successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');
        $header = fgetcsv($file); // Skip first row
        $imported = 0;

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
                'status'            => !empty($row[15]) ? $row[15] : 'Active',
                'profilephoto'      => $row[16] ?? null,
                'cardIssued'        => $row[17] ?? 0,
            ]);

            $imported++;
        }

        fclose($file);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Import Members',
            'details' => "Imported $imported members from CSV",
            'status'  => 'success',
        ]);

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

        if ($request->filled('membertype')) {
            DB::table('membercategory')->updateOrInsert(
                ['membercategoryname' => $request->membertype]
            );
        }

        $data = $request->only([
            'memberid','fullname','gender','dateofbirth','membertype','departmentclass',
            'rollnoemployeeid','yearsemester','email','phone','address','city','state',
            'pincode','joiningdate','status'
        ]);

        $data['cardIssued'] = $request->has('cardIssued');

        if ($request->hasFile('profilephoto')) {
            if ($member->profilephoto && file_exists(public_path('profile_photos/' . $member->profilephoto))) {
                unlink(public_path('profile_photos/' . $member->profilephoto));
            }
            $imageName = time() . '_member.' . $request->profilephoto->extension();
            $request->profilephoto->move(public_path('profile_photos'), $imageName);
            $data['profilephoto'] = $imageName;
        }

        $changes = [];
        foreach ($data as $key => $newValue) {
            $oldValue = $member->$key;
            if ($newValue != $oldValue) {
                $changes[] = strtoupper($key) . ": {$oldValue} → {$newValue}";
            }
        }

        $member->update($data);

        // Log activity
        $details = count($changes) > 0
            ? "Updated Member - {$member->fullname}. Changes: " . implode(', ', $changes)
            : "Updated Member - {$member->fullname} (no changes detected)";

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Edit Member',
            'details' => $details,
            'status'  => 'success'
        ]);

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

        if ($member->profilephoto && file_exists(public_path('profile_photos/' . $member->profilephoto))) {
            unlink(public_path('profile_photos/' . $member->profilephoto));
        }

        $member->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Member',
            'details' => "Deleted Member: {$member->fullname} (ID: {$member->id})",
            'status'  => 'success'
        ]);

        return back()->with('success', 'Member deleted successfully!');
    }

    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('memberid', 'LIKE', "%$search%");
            });
        }

        if ($request->filter && $request->filter !== 'All') {
            if (in_array($request->filter, ['Active', 'Inactive'])) {
                $query->where('status', $request->filter);
            } else {
                $query->where('membertype', $request->filter);
            }
        }

        $members = $query->orderBy('id', 'DESC')->paginate(10);
        $membercategories = DB::table('membercategory')->get();

        return view('all_member', compact('members', 'membercategories'));
    }
}
