@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Ajouter un mouvement de caisse</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cash_movements.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Type de mouvement</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="deposit">Dépôt</option>
                        <option value="withdraw">Retrait</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Montant (DA)</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('cash_movements.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
