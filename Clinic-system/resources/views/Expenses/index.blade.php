@extends('layouts.admin')

@section('title', 'Toutes les Dépenses')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Toutes les Dépenses</h2>
        <a href="{{ route('expense.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une Dépense
        </a>
    </div>

    {{-- Search bar --}}
<div class="container my-4">
    <form method="GET" action="{{ route('expenses.index') }}" class="row g-3 align-items-end">

        {{-- 🔍 Search --}}
        <div class="col-md-4">
            <label class="form-label">Rechercher</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Titre, notes...">
        </div>



        {{-- 📅 Date From --}}
        <div class="col-md-2">
            <label class="form-label">Du</label>
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>

        {{-- 📅 Date To --}}
        <div class="col-md-2">
            <label class="form-label">Au</label>
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Trier par</label>
            <select name="sort" class="form-select">
                <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>Plus récent</option>
                <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>Plus ancien</option>
            </select>
        </div>


        {{-- Buttons --}}
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Filtrer
            </button>
        </div>
    </form>
</div>


    {{-- Expenses Table --}}
    <div class="card shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Montant (DA)</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                            <tr data-id="{{ $expense->id }}">
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->title }}</td>
                                <td>{{ number_format($expense->amount, 2, ',', ' ') }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
                                <td>{{ $expense->notes }}</td>
                                <td>
                                    <a href="{{ route('expense.edit', $expense->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                </td>


                                <td>
                                    <button class="btn btn-sm btn-danger delete-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-action="{{ route('expense.delete', $expense->id) }}">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune dépense trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination DELETED --}}
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirmer la Suppression</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cette dépense ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // the button that triggered the modal
        const action = button.getAttribute('data-action'); // the action URL
        const form = document.getElementById('deleteForm');
        form.setAttribute('action', action);
    });
</script>

@endsection
