<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\AutoNumber;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ActivityLogger;
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
            'auto_generate'     => 'nullable|string|in:enable,disable',
        ]);

        // AUTO-GENERATE MEMBER ID IF ENABLED OR EMPTY
        if ($request->auto_generate === 'enable' || empty($validated['memberid'])) {
            $autoMember = AutoNumber::where('type', 'member_id')->first();
            if ($autoMember) {
                $autoMember->last_number += 1;
                $autoMember->save();
                $validated['memberid'] = $autoMember->prefix . str_pad($autoMember->last_number, $autoMember->digits, '0', STR_PAD_LEFT);
            } else {
                $validated['memberid'] = 'MBR' . date('YmdHis'); // fallback
            }
        }

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
            'details' => "Added Member: {$member->fullname} (ID: {$member->memberid})",
            'status'  => 'success',
        ]);

        return back()->with('success', 'Member added successfully! Generated ID: ' . $validated['memberid']);
    }

public function import(Request $request)
{
    $request->validate([
        'import_file' => 'required|file|mimes:csv,txt|max:4096',
    ]);

    $file = fopen($request->file('import_file')->getRealPath(), 'r');

    // Skip header
    $header = fgetcsv($file);
    $imported = 0;

    while (($row = fgetcsv($file)) !== false) {

        $memberId         = trim($row[0] ?? '');
        $fullname         = trim($row[1] ?? '');
        $gender           = trim($row[2] ?? '');
        $dateofbirth      = trim($row[3] ?? '');
        $membertype       = trim($row[4] ?? '');
        $departmentclass  = trim($row[5] ?? '');
        $rollnoemployeeid = trim($row[6] ?? '');
        $yearsemester     = trim($row[7] ?? '');
        $email            = trim($row[8] ?? '');
        $phone            = trim($row[9] ?? '');
        $address          = trim($row[10] ?? '');
        $city             = trim($row[11] ?? '');
        $state            = trim($row[12] ?? '');
        $pincode          = trim($row[13] ?? '');
        $joiningdate      = trim($row[14] ?? '');
        $status           = trim($row[15] ?? 'Active');
        $profilephoto     = trim($row[16] ?? '');
        $cardIssued       = intval($row[17] ?? 0);

        // Skip empty fullname
        if (empty($fullname)) continue;

        // Auto-generate member ID if empty
        if (empty($memberId)) {
            $autoMember = AutoNumber::where('type', 'member_id')->first();
            if ($autoMember) {
                $autoMember->last_number++;
                $autoMember->save();
                $memberId = $autoMember->prefix .
                            str_pad($autoMember->last_number, $autoMember->digits, '0', STR_PAD_LEFT);
            } else {
                $memberId = 'MBR' . date('YmdHis');
            }
        }

        // Convert dates to Y-m-d
        $dateofbirth = ($dateofbirth && strtotime($dateofbirth))
            ? date('Y-m-d', strtotime($dateofbirth))
            : null;

        $joiningdate = ($joiningdate && strtotime($joiningdate))
            ? date('Y-m-d', strtotime($joiningdate))
            : null;

        Member::create([
            'memberid'          => $memberId,
            'fullname'          => $fullname,
            'gender'            => $gender,
            'dateofbirth'       => $dateofbirth,
            'membertype'        => $membertype,
            'departmentclass'   => $departmentclass,
            'rollnoemployeeid'  => $rollnoemployeeid,
            'yearsemester'      => $yearsemester,
            'email'             => $email,
            'phone'             => $phone,
            'address'           => $address,
            'city'              => $city,
            'state'             => $state,
            'pincode'           => $pincode,
            'joiningdate'       => $joiningdate,
            'status'            => $status,
            'profilephoto'      => $profilephoto,
            'cardIssued'        => $cardIssued,
        ]);

        $imported++;
    }

    fclose($file);

    ActivityLogger::log('Import Books', "Imported $imported books from CSV");

    return redirect()->back()->with('success', "$imported members imported successfully!");
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

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Member',
            'details' => "Deleted Member: {$member->fullname} (ID: {$member->memberid})",
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

    public function member_report()
    {
        $members = Member::orderBy('created_at', 'desc')->get();
        $membercategories = DB::table('membercategory')->get();
        return view('admin.members.member_report', compact('members', 'membercategories'));
    }

    public function downloadSample()
{
    $filePath = public_path('sample/add_member_sample_import_file.csv');

    return response()->download($filePath, 'Sample-Member-Import.csv', [
        'Content-Type' => 'text/csv',
    ]);
}
}
