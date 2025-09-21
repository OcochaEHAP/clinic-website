@extends('layouts.admin')
@section('title', 'Modifier le paiement')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">Modifier le Paiement</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Informations du Paiement
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('payment.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Patient Name (Static) -->
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control"
                           value="{{ $payment->patient->first_name }} {{ $payment->patient->last_name }}"
                           readonly>
                    <input type="hidden" name="patient_id" value="{{ $payment->patient_id }}">
                </div>

                <!-- Montant -->
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant (DA)</label>
                    <input type="number" step="0.01"
                           name="amount" id="amount"
                           class="form-control"
                           value="{{ $payment->amount }}" required>
                </div>

                <!-- Méthode de paiement -->
                <div class="mb-3">
                    <label for="method" class="form-label">Méthode</label>
                    <select name="method" id="method" class="form-select" required>
                        <option value="Espèces" {{ $payment->method == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                        <option value="CCP" {{ $payment->method == 'CCP' ? 'selected' : '' }}>CCP</option>
                        <option value="Cheque" {{ $payment->method == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                    </select>
                </div>

                <!-- Date de paiement -->
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Date de paiement</label>
                    <input type="date"
                           name="payment_date" id="payment_date"
                           class="form-control"
                           value="{{ $payment->payment_date }}" required>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control">{{ $payment->notes }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">⬅ Retour</a>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
