<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

    return view('patients.index', compact('patients'));
}

    // // public function index()
    // {
    // $patients = Patient::all();
    // return view('patients.index', compact('patients'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patinets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'age' => 'nullable|integer',
        'address' => 'nullable|string',
        'phone' => 'nullable|string',
        'card_number' => 'nullable|string',
        'interventions' => 'nullable|array',
        'chirurgie_generale' => 'nullable|string',
        'weight' => 'nullable|numeric',
        'tall' => 'nullable|numeric',
        'bmi' => 'nullable|numeric',
        'morphologie' => 'nullable|string',
        'peau' => 'nullable|string',
        'graisse' => 'nullable|string',
        'zones' => 'nullable|string',
        'hypertrophie' => 'nullable|string',
        'ptose' => 'nullable|string',
        'asymetrie' => 'nullable|string',
    'tabac' => 'required|in:oui,non',
    'alcool' => 'required|in:oui,non',
    'autres_habitudes' => 'nullable|max:255',
    'operations_precedentes' => 'nullable|max:255',
    'complications' => 'nullable|max:255',
    ]);

    // save interventions as JSON
    if ($request->has('interventions')) {
        $data['interventions'] = json_encode($request->interventions);
    }

    Patient::create($data);

    return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('patients.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $patient = Patient::findOrFail($id);
    return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    // 1. Validate incoming data
    $validatedData = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'card_number' => 'nullable|string|max:50',
        'interventions' => 'nullable|array', // must be array
        'chirurgie_generale' => 'nullable|string',
        'weight' => 'nullable|numeric',
        'tall' => 'nullable|numeric',
        'bmi' => 'nullable|numeric',
        'morphologie' => 'nullable|string',
        'peau' => 'nullable|string',
        'graisse' => 'nullable|string',
        'zones' => 'nullable|string',
        'hypertrophie' => 'nullable|string',
        'ptose' => 'nullable|string',
        'asymetrie' => 'nullable|string',
        'tabac' => 'nullable|string',
        'alcool' => 'nullable|string',
        'autres_habitudes' => 'nullable|string',
        'operations_precedentes' => 'nullable|string',
        'complications' => 'nullable|string',
    ]);

    // 2. Find the patient
    $patient = Patient::findOrFail($id);

    // 3. Handle JSON column
    if ($request->has('interventions')) {
        $validatedData['interventions'] = array_filter($request->input('interventions'));
    } else {
        $validatedData['interventions'] = [];
    }

    // 4. Update
    $patient->update($validatedData);

    // 5. Redirect with message
    return redirect()->route('patients.index')
        ->with('success', 'Patient updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(Patient $patient)
{
    $patient->delete();

    return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
}

}
