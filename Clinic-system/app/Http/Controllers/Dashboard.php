<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\RDV;
use Carbon\Carbon;
use DB;

class Dashboard extends Controller
{
    public function index()
    {
        // Totals
        $totalPatients   = Patient::count();
        $totalPayments   = Payment::sum('amount');
        $totalExpenses   = Expense::sum('amount');
        $netProfit       = $totalPayments - $totalExpenses;

        // Monthly stats (last 6 months)
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse()->values();

        $paymentsPerMonth = $months->map(function ($month) {
            return Payment::whereYear('payment_date', substr($month, 0, 4))
                          ->whereMonth('payment_date', substr($month, 5, 2))
                          ->sum('amount');
        });

        $expensesPerMonth = $months->map(function ($month) {
            return Expense::whereYear('expense_date', substr($month, 0, 4))
                          ->whereMonth('expense_date', substr($month, 5, 2))
                          ->sum('amount');
        });

        $appointmentsPerMonth = $months->map(function ($month) {
            return RDV::whereYear('date', substr($month, 0, 4))
                              ->whereMonth('date', substr($month, 5, 2))
                              ->count();
        });

        // Recent records
        $recentPayments = Payment::with('patient')
                                ->latest()
                                ->take(5)
                                ->get();

        $recentExpenses = Expense::latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalPayments',
            'totalExpenses',
            'netProfit',
            'months',
            'paymentsPerMonth',
            'expensesPerMonth',
            'appointmentsPerMonth',
            'recentPayments',
            'recentExpenses'
        ));
    }
}
