<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Payment::with('patient');

if ($request->filled('search')) {
    $search = $request->input('search');
    $query->whereHas('patient', function ($q) use ($search) {
        $q->where('first_name', 'like', "%{$search}%")
          ->orWhere('last_name', 'like', "%{$search}%");
    })->orWhere('method', 'like', "%{$search}%")
      ->orWhere('notes', 'like', "%{$search}%");
}
if ($request->filled('method')) {
    $query->where('method', $request->method);
}

if ($request->filled('from') && $request->filled('to')) {
    $query->whereBetween('payment_date', [$request->from, $request->to]);
}


    $payments = $query->orderBy('payment_date', 'desc')->get();

    return view('payments.index', compact('payments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         $query = Patient::query();

    if ($request->filled('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    $patients = $query->get(); // keep pagination
        return view('payments.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'amount' => 'required|numeric|min:0',
        'method' => 'required|in:Espèces,CCP,Cheque',
        'payment_date' => 'required|date',
        'notes' => 'nullable|string'
    ]);

    Payment::create($validated);

    // return redirect()->route('payments.index')->with('success', 'Paiement ajouté avec succès.');
    // return response()->json(['succes' => true]);
    if (auth()->user()->role === 'admin') {
            return redirect()->route('payments.index')
            ->with('success', 'Paiement bloc ajouté avec succès.');
        } elseif (auth()->user()->role === 'assistant') {
            return redirect()->route('payments.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
          if ($request->has('patient_id')) {
        $patient = Patient::findOrFail($request->get('patient_id'));
        return view('payments.form', compact('patient'));
    }

    // otherwise, show the patient list first
    $patients = Patient::get();
    return view('payment.create', compact('patients'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        $patient = Patient::findOrFail($payment->patient_id);
        return view('payments.edit', compact('payment', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
          $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'amount' => 'required|numeric|min:0',
        'method' => 'required|in:Espèces,CCP,Cheque',
        'payment_date' => 'required|date',
        'notes' => 'nullable|string'
    ]);

    // $payment->update($validated);
        $payment->update($validated);

    return redirect()->route('payments.index')
                     ->with('success', 'Paiement mis à jour avec succès ✅');
    // return response()->json(['succes'=> true]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
