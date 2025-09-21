@extends('layouts.admin')
@section('title','Ajouter un paiement')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('payment.create') }}" method="GET" class="d-flex" style="max-width: 400px;">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control me-2" placeholder="Rechercher un patient...">
        <button type="submit" class="btn btn-primary">
            Rechercher
        </button>
    </form>
</div>

    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Sélectionner un Patient</h4>
            <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-person-plus"></i> Nouveau Patient
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Âge</th>
                        <th>Téléphone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $patient->first_name }}</td>
                            <td class="fw-semibold">{{ $patient->last_name }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>
                                <button class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        data-id="{{ $patient->id }}"
                                        data-name="{{ $patient->first_name }} {{ $patient->last_name }}">
                                    <i class="bi bi-cash-coin"></i> Ajouter Paiement
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Aucun patient enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 🔹 Bootstrap Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('payment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="patient_id" id="modal-patient-id">

        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="paymentModalLabel">Nouveau Paiement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Patient</label>
              <input type="text" class="form-control" id="modal-patient-name" disabled>
          </div>
          <div class="mb-3">
              <label for="amount" class="form-label">Montant</label>
              <input type="number" name="amount" id="amount" class="form-control" required>
          </div>
          <div class="mb-3">
              <label for="method" class="form-label">Méthode de paiement</label>
              <select name="method" id="method" class="form-select" required>
                  <option value="Espèces">Espèces</option>
                  <option value="CCP">CCP</option>
                  <option value="Cheque">Cheque</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="payment_date" class="form-label">Date de Paiement</label>
            <input type="date" class="form-control" name="payment_date"
            value="{{ date('Y-m-d') }}" required>
          </div>
          <div class="mb-3">
              <label for="notes" class="form-label">Notes</label>
              <textarea name="notes" id="notes" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM is loaded');

    var paymentModal = document.getElementById('paymentModal');
    paymentModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var patientId = button.getAttribute('data-id');
        var patientName = button.getAttribute('data-name');

        // Fill modal fields
        document.getElementById('modal-patient-id').value = patientId;
        document.getElementById('modal-patient-name').value = patientName;
    });
});
</script>

@endsection


