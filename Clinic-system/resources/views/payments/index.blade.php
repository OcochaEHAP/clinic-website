@extends('layouts.admin')
@section('title', 'Liste des Paiements')

@section('content')
<div class="container my-5">
    <form method="GET" action="{{ route('payments.index') }}" class="row g-3 mb-4">
    <div class="col-md-3">
        <select name="method" class="form-select">
            <option value="">Toutes méthodes</option>
            <option value="Espèces" {{ request('method') == 'Especes' ? 'selected' : '' }}>Espèces</option>
            <option value="Cheque" {{ request('method') == 'Cheque' ? 'selected' : '' }}>Chèque</option>
            <option value="CCP" {{ request('method') == 'CCP' ? 'selected' : '' }}>CCP</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-success w-100">Filtrer</button>
    </div>
</form>

    <form method="GET" action="{{ route('payments.index') }}" class="mb-3 d-flex">
    <input type="text" name="search" value="{{ request('search') }}"
           class="form-control me-2" placeholder="Rechercher un paiement...">
    <button type="submit" class="btn btn-primary">Chercher</button>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Paiements</h2>
        <a href="{{ route('payment.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouveau Paiement
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Montant (DA)</th>
                    <th>Méthode</th>
                    <th>Date</th>
                    <th>Notes</th>
                    <th class="text-center">Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->patient->first_name }} {{ $payment->patient->last_name }}</td>
                        <td>{{ number_format($payment->amount, 2, ',', ' ') }}</td>
                        <td>
                            <span class="badge bg-info text-dark text-uppercase">
                                {{ $payment->method }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                        <td>{{ $payment->notes ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{route('payment.edit', $payment->id)}}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            </td>

                            <td>

                            <form action="{{route('payment.delete', $payment->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $payment->id }}"
                                        {{-- onclick="return confirm('Supprimer ce paiement ?')" --}}
                                   > Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Aucun paiement trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteModalLabel">Confirmer la Suppression</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer ce paiement ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
        </div>
        </div>
    </div>
    </div>
</div>

<script>
    let deleteId = null;

    // Open modal when delete button clicked
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });
    });

    // Confirm delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if(deleteId) {
            fetch(`/admin/payments/${deleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    document.querySelector(`tr[data-id="${deleteId}"]`).remove();
                    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                }
            });
        }
    });
</script>
@endsection
