<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::table('membercategory')->insert([
            'membercategoryname' => $request->membercategoryname,
            'maxbooks' => $request->maxbooks,
            'fineperday' => $request->fineperday,
            'created_at' => now(),
            'updated_at' => now(),
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

    return back()->with('success', 'Member category updated successfully!');
}


    public function destroy($id)
    {
        DB::table('membercategory')->where('id', $id)->delete();
        return back()->with('success', 'Member category deleted successfully!');
    }

    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt|max:2048',
    ]);

    $file = fopen($request->file('csv_file')->getRealPath(), 'r');
    $header = fgetcsv($file); // Skip header row if present

    while (($data = fgetcsv($file)) !== false) {
        DB::table('membercategory')->insert([
            'membercategoryname' => $data[0],
            'maxbooks' => $data[1],
            'fineperday' => $data[2],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    fclose($file);

    return redirect()->back()->with('success', 'Categories imported successfully!');
}
}
