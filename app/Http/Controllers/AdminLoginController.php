<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    /**
     * Handle admin login submission
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Find active admin using case-insensitive email and status
        $admin = Admin::whereRaw('LOWER(email) = ?', [strtolower($request->email)])
                      ->where('status', true)
                      ->first();

        // Check if admin exists and password is correct
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Login success: store session
        session([
            'admin_id'   => $admin->id,
            'admin_name' => $admin->name,
            'admin_role' => $admin->role,
        ]);

        // Update last login time
        $admin->update(['last_login_at' => now()]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Dashboard page
     */
    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login.form')
                             ->with('error', 'Please login first.');
        }

        return view('welcome', [
            'admin_name' => session('admin_name'),
            'admin_role' => session('admin_role'),
        ]);
    }

    /**
     * Logout and clear session
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login.form')
                         ->with('error', 'You have been logged out.');
    }
}
