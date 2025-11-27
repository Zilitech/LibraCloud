<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoNumber;

class AutoNumberController extends Controller
{
    // Show the form
    public function create()
    {
        return view('auto_number_form');
    }

    // Store the auto number configuration
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'prefix' => 'required|string',
            'last_number' => 'required|integer',
            'digits' => 'required|integer',
            'auto_generate' => 'nullable|string'
        ]);

        $autoNumber = AutoNumber::updateOrCreate(
            ['type' => $request->type],
            [
                'prefix' => $request->prefix,
                'last_number' => $request->last_number,
                'digits' => $request->digits
            ]
        );

        return back()->with('success', 'Auto Number configuration saved successfully.');
    }

    // Preview auto-generated numbers (AJAX)
    public function preview()
    {
        $book = AutoNumber::where('type','book_code')->first();
        $member = AutoNumber::where('type','member_id')->first();

        $bookCode = $book ? $book->prefix . str_pad($book->last_number + 1, $book->digits, '0', STR_PAD_LEFT) : '';
        $memberId = $member ? $member->prefix . str_pad($member->last_number + 1, $member->digits, '0', STR_PAD_LEFT) : '';

        return response()->json([
            'book_code' => $bookCode,
            'member_id' => $memberId
        ]);
    }
}
