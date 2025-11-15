<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembercardController extends Controller
{
    /**
     * Show all members in the membership card page
     */
    public function index()
    {
        // Fetch all members
        $members = Member::orderBy('id', 'DESC')->get();

        // Pass data to blade
        return view('membership_card', compact('members'));
    }
}
