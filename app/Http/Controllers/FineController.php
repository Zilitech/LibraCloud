<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fine;
use App\Models\OverdueBook;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FineController extends Controller
{
    // Show Fine Management page
    public function index()
    {
        $fines_status = Fine::all();
        // Fetch all overdue books with fines info
        $all_fines = OverdueBook::orderBy('created_at', 'desc')->get();
        return view('fine_management', compact('all_fines','fines_status'));
    }

    // Mark fine as paid
    public function markAsPaid(Request $request, $issue_id)
    {
        try {
            DB::beginTransaction();

            // Fetch the overdue book
            $overdue = OverdueBook::where('issue_id', $issue_id)->first();
            if (!$overdue) {
                return response()->json(['error' => 'Overdue book not found.'], 404);
            }

            // Create or update the fine record
            $fine = Fine::firstOrCreate(
                ['issue_id' => $issue_id],
                [
                    'issue_id'    =>$overdue->issue_id,
                    'member_id'   => $overdue->member_id,
                    'member_name' => $overdue->member_name,
                    'book_id'     => $overdue->book_id ?? null,
                    'book_name'   => $overdue->book_name,
                    'issue_date'  => $overdue->issue_date,
                    'due_date'    => $overdue->due_date,
                    'days_overdue'=> $overdue->days_overdue,
                    'fine'        => $overdue->fine,  // <--- fixed column name
                    'status'      => 'Paid',
                ]
            );

            // If the fine already exists but is not paid, update it
            if ($fine->status !== 'Paid') {
                $fine->update([
                    'status'  => 'Paid',
                    'paid_at' => now(),
                    'fine'    => $overdue->fine,
                ]);
            }

            // Update overdue book status


            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action'  => 'Mark Fine Paid',
                'details' => "Fine ID: {$fine->id} marked as paid",
                'status'  => 'success',
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Fine marked as paid successfully.',
                'fine_id' => $fine->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json([
                'error'   => 'Something went wrong.',
                'message' => $e->getMessage(),
                'line'    => $e->getLine()
            ], 500);
        }
    }

    // Delete fine
    public function destroy($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Fine',
            'details' => "Fine ID: {$id} deleted",
            'status'  => 'success',
        ]);

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }

    // Optional: create fine from OverdueBook (Pending)
    public function createFromOverdue($overdueId)
    {
        $overdue = OverdueBook::findOrFail($overdueId);

        $fine = Fine::create([
            'issue_id'    => $overdue->issue_id,
            'member_id'   => $overdue->member_id,
            'book_id'     => $overdue->book_id ?? null,
            'member_name' => $overdue->member_name,
            'book_name'   => $overdue->book_name,
            'issue_date'  => $overdue->issue_date,
            'due_date'    => $overdue->due_date,
            'return_date' => now(),
            'days_overdue'=> $overdue->days_overdue,
            'fine'        => $overdue->fine, // fixed column name
            'status'      => 'Pending',
        ]);

        $overdue->status = 'Pending';
        $overdue->save();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Create Fine',
            'details' => "Fine ID: {$fine->id} created from Overdue Book ID: {$overdue->id}",
            'status'  => 'success',
        ]);

        return redirect()->route('fines.index')->with('success', 'Fine created successfully.');
    }

    // Optional: Print receipt (add later if needed)
    public function printReceipt($id)
    {
        $fine = Fine::findOrFail($id);
        // You can return a PDF view or blade
        return view('fines.print_receipt', compact('fine'));
    }
}
