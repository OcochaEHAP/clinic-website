@extends('layouts.admin')

@section('title', 'Modifier Paiement Bloc')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        Modifier Paiement Bloc – Patient :
                        <strong>{{ $blocPayment->patient->first_name }} {{ $blocPayment->patient->last_name }}</strong>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('bloc-payments.update', $blocPayment->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        {{-- Amount Received --}}
                        <div class="mb-3">
                            <label for="amount_received" class="form-label">Montant Reçu</label>
                            <input type="number" step="0.01" name="amount" id="amount"
                                   class="form-control @error('amount') is-invalid @enderror"
                                   value="{{ old('amount_received', $blocPayment->amount) }}" required>
                            @error('amount_received')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Location de Bloc --}}
                        <div class="mb-3">
                            <label for="location_de_bloc" class="form-label">Location de Bloc</label>
                            <input type="number" step="0.01" name="location_de_bloc" id="location_de_bloc"
                                   class="form-control"
                                   value="{{ old('location_de_bloc', $blocPayment->location_de_bloc) }}">
                        </div>

                        {{-- Aide --}}
                        <div class="mb-3">
                            <label for="aide" class="form-label">Aide</label>
                            <input type="number" step="0.01" name="aide" id="aide"
                                   class="form-control"
                                   value="{{ old('aide', $blocPayment->aide) }}">
                        </div>

                        {{-- La Gaine --}}
                        <div class="mb-3">
                            <label for="la_gaine" class="form-label">La Gaine</label>
                            <input type="number" step="0.01" name="la_gaine" id="la_gaine"
                                   class="form-control"
                                   value="{{ old('la_gaine', $blocPayment->la_gaine) }}">
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date"
                                   class="form-control @error('date') is-invalid @enderror"
                                   value="{{ old('date', $blocPayment->date) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes', $blocPayment->notes) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('bloc-payments.index') }}" class="btn btn-secondary">Retour</a>
                            <button type="submit" class="btn btn-warning">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
