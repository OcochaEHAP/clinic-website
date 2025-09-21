<?php

namespace App\Http\Controllers;

use App\Models\BlocPayment;
use App\Models\Patient;
use Illuminate\Http\Request;

class BlocPaymentController extends Controller
{
    /**
     * Display a listing of the bloc payments.
     */
    public function index()
    {
        $blocPayments = BlocPayment::with('patient')->latest()->get();

        return view('bloc-payments.index', compact('blocPayments'));
    }

    /**
     * Show the form for selecting a patient / creating a new bloc payment.
     */
    public function create(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        $patients = $query->get();

        return view('bloc-payments.create', compact('patients'));
    }

    /**
     * Store a newly created bloc payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'amount'   => 'required|numeric|min:0',
            'location_de_bloc'  => 'nullable|numeric|min:0',
            'aide'              => 'nullable|numeric|min:0',
            'la_gaine'          => 'nullable|numeric|min:0',
            'date'              => 'required|date',
            'notes'             => 'nullable|string',
        ]);

        BlocPayment::create($validated);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('bloc-payments.index')
            ->with('success', 'Paiement bloc ajouté avec succès.');
        } elseif (auth()->user()->role === 'assistant') {
            return redirect()->route('bloc-payments.create');
        }

    }

    /**
     * Show the form for editing the specified bloc payment.
     */
    public function edit(BlocPayment $blocPayment)
    {
        return view('bloc-payments.edit', compact('blocPayment'));
    }

    /**
     * Update the specified bloc payment.
     */
    public function update(Request $request, BlocPayment $blocPayment)
    {
        $validated = $request->validate([
            'amount'            => 'required|numeric|min:0',
            'location_de_bloc'  => 'nullable|numeric|min:0',
            'aide'              => 'nullable|numeric|min:0',
            'la_gaine'          => 'nullable|numeric|min:0',
            'date'              => 'required|date',
            'notes'             => 'nullable|string',
        ]);

        $blocPayment->update($validated);

        return redirect()->route('bloc-payments.index')
            ->with('success', 'Paiement bloc mis à jour avec succès.');
    }

    /**
     * Remove the specified bloc payment.
     */
    public function destroy(BlocPayment $blocPayment)
    {
        $blocPayment->delete();

        return redirect()->route('bloc-payments.index')
            ->with('success', 'Paiement bloc supprimé avec succès.');
    }
}
