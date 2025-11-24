<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

    public function generateIdCardPDF(Request $request)
    {
        $request->validate([
            'member_ids' => 'required|array',
        ]);

        $members = Member::whereIn('id', $request->member_ids)->get();

        // Generate base64 barcode for each member
        $d1 = new DNS1D();
        foreach ($members as $member) {
            $member->barcode_base64 = 'data:image/png;base64,' . $d1->getBarcodePNG($member->memberid, 'C128', 2, 50);
        }

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Generate Membership Cards PDF',
            'details' => 'Generated PDF for member IDs: ' . implode(',', $request->member_ids),
            'status' => 'success',
        ]);

        // Load Blade view for multiple cards
        $pdf = Pdf::loadView('idcards_pdf', compact('members'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('membership_cards.pdf'); // open in browser for review
    }
}
