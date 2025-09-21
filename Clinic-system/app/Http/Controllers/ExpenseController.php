<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $query = Expense::query();

    // 🔍 Search by title, notes, or category
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('notes', 'like', "%{$search}%");
        });
    }
        if ($request->has('from') && !empty($request->from)) {
        $query->whereDate('expense_date', '>=', $request->from);
    }
    if ($request->has('to') && !empty($request->to)) {
        $query->whereDate('expense_date', '<=', $request->to);
    }
        $sort = $request->get('sort', 'desc'); // default recent
    // $query->orderBy('expense_date', $sort);
    // $query->orderBy('expense_date', $sort);
    $expenses =  $query->orderBy('expense_date', $sort);

    $expenses = $query->get();
        // $expenses = Expense::all();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
        'title'        => 'required|string|max:255',
        'amount'       => 'required|numeric|min:0',
        'expense_date' => 'required|date',
        'notes'        => 'nullable|string|max:500',
        ]);
        Expense::create($validated);

          return redirect()->route('expenses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $expense = Expense::findOrFail($id);
        $validated = $request->validate([
        'title'        => 'required|string|max:255',
        'amount'       => 'required|numeric|min:0',
        'expense_date' => 'required|date',
        'notes'        => 'nullable|string|max:500',
        ]);

        $expense->update($validated);
        return redirect('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return redirect()->route('expenses.index');

    }
}
