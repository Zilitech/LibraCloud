<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $admin = DB::table('admin_login')
            ->where('email', $request->email)
            ->where('status', true)
            ->first();

        if (!$admin) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Verify hashed password
        if (Hash::check($request->password, $admin->password)) {
            // Store session
            session([
                'admin_id'   => $admin->id,
                'admin_name' => $admin->name,
                'admin_role' => $admin->role,
            ]);

            // Update last login time
            DB::table('admin_login')
                ->where('id', $admin->id)
                ->update(['last_login_at' => now()]);

            return redirect()->route('admin.dashboard');
        }

        // Invalid password
        return back()->with('error', 'Invalid email or password.');
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
