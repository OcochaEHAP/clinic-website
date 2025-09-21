@extends('layouts.admin')

@section('title', 'Modifier une Dépense')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Modifier une Dépense</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('expense.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Titre --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $expense->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Montant --}}
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant (DA)</label>
                    <input type="number" step="0.01" name="amount" id="amount"
                           class="form-control @error('amount') is-invalid @enderror"
                           value="{{ old('amount', $expense->amount) }}" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label for="expense_date" class="form-label">Date de la dépense</label>
                    <input type="date" name="expense_date" id="expense_date"
                           class="form-control @error('expense_date') is-invalid @enderror"
                           value="{{ old('expense_date', $expense->expense_date) }}" required>
                    @error('expense_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Notes --}}
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" rows="3"
                              class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $expense->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
