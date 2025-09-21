@extends('layouts.admin') {{-- adjust to your layout --}}

@section('title', 'Bloc Payments')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Bloc Payments</h2>
        <a href="{{ route('bloc-payments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Bloc Payment
        </a>
    </div>
        @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            {{-- <th>Bloc Name</th> --}}
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Mountant</th>
                            <th>Location de Bloc</th>
                            <th>Aide</th>
                            <th>La Gaine</th>
                            <th>Net Profit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blocPayments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $payment->bloc_name }}</td> --}}
                            <td>{{ $payment->patient->first_name }} {{ $payment->patient->last_name }}</td>
                            <td>{{ $payment->date }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ number_format($payment->location_de_bloc, 2) }}</td>
                            <td>{{ number_format($payment->aide, 2) }}</td>
                            <td>{{ number_format($payment->la_gaine, 2) }}</td>
                            <td class="fw-bold text-success">
                                {{ number_format($payment->net_profit, 2) }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('bloc-payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                                    <!-- Delete Button triggers modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $payment->id }}">
                                        Supprimer
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer<strong>{{ $payment->bloc_name }}</strong>?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('bloc-payments.destroy', $payment->id) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">Aucun paiement en bloc trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
