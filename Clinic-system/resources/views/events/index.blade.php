@extends('layouts.admin')

@section('title', 'Events')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h2 class="mb-0">Les Evenments de {{ $date }}</h2>
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter Evenment
        </a>
    </div>

    {{-- Date Filter --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-auto">
            <input type="date" name="date" value="{{ $date }}" class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-secondary">Filter</button>
        </div>
    </form>

    @if($events->isEmpty())
        <div class="alert alert-info">Aucun Pour Aujourd'hui.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Patient</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>temps</th>
                        <th>Notes</th>
                        <th>Source</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
<tr>
    <td>{{ $event->name ?? 'Unknown' }}</td>
    <td>{{ $event->service }}</td>
    <td>{{ $event->date }}</td>
    <td>{{ $event->time ?? '-' }}</td>
    <td>{{ $event->message ?? '' }}</td>
    <td>
        @if($event->source === 'rdv')
            <span class="badge bg-success">RDV</span>
        @else
            <span class="badge bg-primary">Evenment</span>
        @endif
    </td>


    <td class="text-center">
    @if ($event->source !== 'rdv')

        {{-- Edit button --}}
        <button type="button"
                class="btn btn-sm btn-warning"
                data-bs-toggle="modal"
                data-bs-target="#editModal{{ $event->id }}">
            Modifier
        </button>

        {{-- Delete button --}}
        <button type="button"
                class="btn btn-sm btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal{{ $event->id }}">
            Supprimer
        </button>
    @endif

    </td>
</tr>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Modifier l'événement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Service</label>
            <select name="service" id="service" class="form-select" required>
                        @foreach($services as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $event->date }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Heure</label>
            <input type="time" name="time" class="form-control" value="{{ $event->time }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="message" class="form-control">{{ $event->message }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-warning">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('events.destroy', $event->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title">Supprimer l'événement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment supprimer cet événement pour
          <strong>{{ $event->name ?? 'Patient' }}</strong> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
