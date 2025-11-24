<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class GeneralsettingController extends Controller
{
    /**
     * Display the General Settings page.
     */
    public function index()
    {
        // Fetch first (or only) record from the general_settings table
        $settings = DB::table('general_settings')->first();

        // If no record exists, create one (id = 1) with default empty values
        if (!$settings) {
            DB::table('general_settings')->insert([
                'id' => 1,
                'library_name' => '',
                'library_code' => '',
                'site_name' => 'LibraCloud',
                'address' => '',
                'contact_no' => '',
                'email' => '',
                'max_book_issue' => 1,
                'daily_fine' => 0,
                'grace_period' => 0,
                'due_date_alerts' => 'Enable',
                'new_arrival_alerts' => 'Enable',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $settings = DB::table('general_settings')->first();
        }

        // Load your Blade file
        return view('general_setting', compact('settings'));
    }

    /**
     * Update General Settings and handle file uploads.
     */
    public function update(Request $request)
    {
        $request->validate([
            'library_name' => 'required|string|max:255',
            'site_name' => 'required|string|max:255',
            'email' => 'required|email',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $data = [
            'library_name'       => $request->library_name,
            'library_code'       => $request->library_code,
            'site_name'          => $request->site_name,
            'address'            => $request->address,
            'contact_no'         => $request->contact_no,
            'email'              => $request->email,
            'max_book_issue'     => $request->max_book_issue ?? 1,
            'daily_fine'         => $request->daily_fine ?? 0,
            'grace_period'       => $request->grace_period ?? 0,
            'due_date_alerts'    => $request->due_date_alerts ?? 'Enable',
            'new_arrival_alerts' => $request->new_arrival_alerts ?? 'Enable',
            'updated_at'         => now(),
        ];

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logos'), $logoName);
            $data['logo'] = 'uploads/logos/' . $logoName;
        }

        // Handle Background Image Upload
        if ($request->hasFile('background_image')) {
            $bgName = time() . '_bg.' . $request->background_image->extension();
            $request->background_image->move(public_path('uploads/backgrounds'), $bgName);
            $data['background_image'] = 'uploads/backgrounds/' . $bgName;
        }

        // Insert or update record in DB
        DB::table('general_settings')->updateOrInsert(['id' => 1], $data);

        // Activity Log
        ActivityLog::create([
            'user_id' => Auth::id(), // optional if logged in
            'action'  => 'Update General Settings',
            'details' => 'Library: '.$request->library_name.', Site: '.$request->site_name.', Email: '.$request->email,
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'General settings updated successfully!');
    }
}
