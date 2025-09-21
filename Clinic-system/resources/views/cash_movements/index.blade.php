@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Mouvements de caisse</h3>
        <a href="{{ route('cash_movements.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nouveau mouvement
        </a>
    </div>

    {{-- Filtre par période --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('cash_movements.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Date début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Date fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Filtrer
                    </button>
                    <a href="{{ route('cash_movements.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Résumé --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-success">Total Dépôts</h6>
                    <p class="fs-5 fw-bold">{{ number_format($totalDeposits, 2) }} DA</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-danger">Total Retraits</h6>
                    <p class="fs-5 fw-bold">{{ number_format($totalWithdrawals, 2) }} DA</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-primary">Solde actuel</h6>
                    <p class="fs-5 fw-bold">{{ number_format($balance, 2) }} DA</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Type</th>
                        <th>Montant (DA)</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $m)
                        <tr>
                            <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $m->user->name }}</td>
                            <td>
                                <span class="badge bg-{{ $m->type === 'deposit' ? 'success' : 'danger' }}">
                                    {{ $m->type === 'deposit' ? 'Dépôt' : 'Retrait' }}
                                </span>
                            </td>
                            <td class="fw-bold">{{ number_format($m->amount, 2) }}</td>
                            <td>{{ $m->note ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun enregistrement trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
