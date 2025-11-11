<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    /**
     * Handle admin login form submission.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Fetch active admin
        $admin = DB::table('admin_logins')
            ->where('email', $request->email)
            ->where('status', true)
            ->first();

        if (!$admin) {
            return back()->with('error', 'Invalid email or password.');
        }

        // ✅ Verify hashed password
        if (Hash::check($request->password, $admin->password)) {
            // Store session
            session([
                'admin_id'   => $admin->id,
                'admin_name' => $admin->name,
                'admin_role' => $admin->role,
            ]);

            // Update last login timestamp
            DB::table('admin_logins')
                ->where('id', $admin->id)
                ->update(['last_login_at' => now()]);

            return redirect()->route('admin.dashboard');
        }

        // ❌ Invalid credentials
        return back()->with('error', 'Invalid email or password.');
    }

    /**
     * Display admin dashboard (only if logged in).
     */
    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect('/')->with('error', 'Please login first.');
        }

        return view('dashboard', [
            'admin_name' => session('admin_name'),
            'admin_role' => session('admin_role'),
        ]);
    }

    /**
     * Logout and destroy session.
     */
    public function logout()
    {
        session()->flush();
        return redirect('/')->with('error', 'You have been logged out.');
    }
}
