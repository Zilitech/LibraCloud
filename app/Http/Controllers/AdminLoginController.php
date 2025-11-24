<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;


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

        // Find active admin
        $admin = Admin::whereRaw('LOWER(email) = ?', [strtolower($request->email)])
                      ->where('status', true)
                      ->first();

        // Check if admin exists and password is correct
        if (!$admin || !Hash::check($request->password, $admin->password)) {

            // Log failed login attempt
            ActivityLog::create([
                'user_id' => $admin->id ?? null, // null if email not found
                'action'  => 'Admin Login Attempt',
                'details' => 'Failed login for email: ' . $request->email,
                'status'  => 'failed',
            ]);

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

        // Log successful login
        ActivityLog::create([
            'user_id' => $admin->id,
            'action'  => 'Admin Login',
            'details' => 'Admin logged in successfully: ' . $admin->name,
            'status'  => 'success',
        ]);

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
        $adminId = session('admin_id');
        $adminName = session('admin_name');

        // Log logout
        ActivityLog::create([
            'user_id' => $adminId,
            'action'  => 'Admin Logout',
            'details' => 'Admin logged out successfully: ' . $adminName,
            'status'  => 'success',
        ]);

        session()->flush();

        return redirect()->route('admin.login.form')
                         ->with('error', 'You have been logged out.');
    }
}
