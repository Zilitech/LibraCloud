<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class MembercategoryController extends Controller
{
    public function index()
    {
        $membercategories = DB::table('membercategory')->orderBy('id', 'desc')->get();
        return view('member_category', compact('membercategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'membercategoryname' => 'required|string|max:255',
        ]);

        $id = DB::table('membercategory')->insertGetId([
            'membercategoryname' => $request->membercategoryname,
            'maxbooks' => $request->maxbooks,
            'fineperday' => $request->fineperday,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Member Category',
            'details' => 'Added member category ID: ' . $id,
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Member category added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'membercategoryname' => 'required|string|max:255',
            'maxbooks' => 'required|integer',
            'fineperday' => 'required|integer',
        ]);

        DB::table('membercategory')
            ->where('id', $request->id)
            ->update([
                'membercategoryname' => $request->membercategoryname,
                'maxbooks' => $request->maxbooks,
                'fineperday' => $request->fineperday,
                'updated_at' => now(),
            ]);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Member Category',
            'details' => 'Updated member category ID: ' . $request->id,
            'status' => 'success',
        ]);

        return back()->with('success', 'Member category updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('membercategory')->where('id', $id)->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Member Category',
            'details' => 'Deleted member category ID: ' . $id,
            'status' => 'success',
        ]);

        return back()->with('success', 'Member category deleted successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');
        $header = fgetcsv($file); // Skip header row if present
        $imported = 0;

        while (($data = fgetcsv($file)) !== false) {
            DB::table('membercategory')->insert([
                'membercategoryname' => $data[0],
                'maxbooks' => $data[1],
                'fineperday' => $data[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $imported++;
        }

        fclose($file);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Import Member Categories',
            'details' => "Imported $imported member categories from CSV",
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Categories imported successfully!');
    }
}
