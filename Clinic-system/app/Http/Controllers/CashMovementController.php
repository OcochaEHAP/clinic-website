<?php

namespace App\Http\Controllers;

use App\Models\CashMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashMovementController extends Controller
{
    // Show list (admin only)
public function index(Request $request)
{
    $query = CashMovement::with('user');

    // Apply date range filter if provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date . " 00:00:00",
            $request->end_date . " 23:59:59"
        ]);
    }

    $movements = $query->latest()->get();

    // Summary
    $totalDeposits = $query->clone()->where('type', 'deposit')->sum('amount');
    $totalWithdrawals = $query->clone()->where('type', 'withdraw')->sum('amount');
    $balance = $totalDeposits - $totalWithdrawals;

    return view('cash_movements.index', compact(
        'movements',
        'totalDeposits',
        'totalWithdrawals',
        'balance'
    ));
}


    // Show form to create
    public function create()
    {
        return view('cash_movements.create');
    }

    // Store movement
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:deposit,withdraw',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        CashMovement::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        if (auth()->user()->role === 'admin') {
        return redirect()->route('cash_movements.index')
                         ->with('success', 'Cash movement recorded successfully.');
        } else {
            return redirect()->route('cash_movements.create');
        }

    }
}

