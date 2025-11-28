<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailSetting;

class EmailSettingController extends Controller
{
    // Show form with existing settings
    public function edit()
    {
        $settings = EmailSetting::first(); // only one row
        return view('email_setting', compact('settings'));
    }

    // Save or update settings
    public function update(Request $request)
    {
        $validated = $request->validate([
            'email_engine' => 'required|string',
            'smtp_username' => 'required|email',
            'smtp_password' => 'required|string',
            'smtp_server' => 'required|string',
            'smtp_port' => 'required|integer',
            'smtp_security' => 'required|in:OFF,SSL,TLS',
            'smtp_auth' => 'required|in:ON,OFF',
        ]);

        $settings = EmailSetting::first();

        if ($settings) {
            $settings->update($validated);
        } else {
            EmailSetting::create($validated);
        }

        return redirect()->back()->with('success', 'Email settings saved successfully!');
    }
}
