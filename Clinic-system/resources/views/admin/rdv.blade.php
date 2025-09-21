@extends('layouts.admin')
@section('styles')
{{-- <link rel="stylesheet" href="{{asset('css/adminRDV.css')}}"> --}}

@endsection


@section('title','Rendez-vous')


@section('content')
<div class="d-flex justify-content-end m-3">
    <form method="GET" action="{{ route('rdv.index') }}" class="d-flex gap-2" style="margin-right: 2rem">
        <select name="type" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Tous les RDVs --</option>
            <option value="clinique" {{ request('type') == 'clinique' ? 'selected' : '' }}>clinique</option>
            <option value="bloc" {{ request('type') == 'bloc' ? 'selected' : '' }}>Bloc</option>
        </select>
        <a href="{{ route('rdv.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
    </form>
</div>

<div class="mb-3">



    <form method="GET" action="{{ route('rdv.index') }}" class="row g-2 mt-2 justify-content-center">
        <!-- Search by name -->
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Chercher par nom ou   telephone" value="{{ request('search') }}">
        </div>

        <!-- Filter by service -->
        <div class="col-md-3">
          <select name="service" class="form-select" onchange="this.form.submit()">
    <option value="">Tous les Services</option>
    <option value="consultation" {{ request('service') == 'consultation' ? 'selected' : '' }}>Consultation</option>
    <option value="esthetique" {{ request('service') == 'esthetique' ? 'selected' : '' }}>Esthétique</option>
    <option value="Laser Epilasion" {{ request('service') == 'Laser Epilasion' ? 'selected' : '' }}>Laser Épilation</option>
    <option value="botox" {{ request('service') == 'botox' ? 'selected' : '' }}>Botox</option>
    <option value="filler" {{ request('service') == 'filler' ? 'selected' : '' }}>Filler</option>
    <option value="hydrafacial" {{ request('service') == 'hydrafacial' ? 'selected' : '' }}>Hydrafacial</option>
    <option value="HIFU visage" {{ request('service') == 'HIFU visage' ? 'selected' : '' }}>HIFU Visage</option>
    <option value="HIFU vaginal" {{ request('service') == 'HIFU vaginal' ? 'selected' : '' }}>HIFU Vaginal</option>
    <option value="Drainage lymphatique" {{ request('service') == 'Drainage lymphatique' ? 'selected' : '' }}>Drainage Lymphatique</option>
    <option value="cavitation" {{ request('service') == 'cavitation' ? 'selected' : '' }}>Cavitation</option>
    <option value="Radio frequence" {{ request('service') == 'Radio frequence' ? 'selected' : '' }}>Radio Fréquence</option>
</select>

        </div>

        <!-- Filter by status -->
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Tout les Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>en attente</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>confirme</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>annuler</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
</div>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"> Gestion des Rendez-vous</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nom complet</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rdvs as $rdv)
                        <tr>
                            <td>{{ $rdv->name }}</td>
                            <td>{{ $rdv->phone }}</td>
                            <td>{{ $rdv->email ?? '-' }}</td>
                            <td><span class="badge bg-info text-dark">{{ $rdv->date }}</span></td>
                            <td>{{ ucfirst($rdv->service) }}</td>
                            <td>{{ $rdv->message ?? '-' }}</td>
                            <td>
                                @if($rdv->status === 'pending')
                                    <span class="badge bg-warning text-dark"> En attente</span>
                                @elseif($rdv->status === 'confirmed')
                                    <span class="badge bg-success"> Confirmé</span>
                                @else
                                    <span class="badge bg-danger"> Annulé</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($rdv->status === 'pending')
                                    <form action="{{ route('rdv.confirm', $rdv->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success" style="margin-bottom: .25rem" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $rdv->id }}" > Confirmer</button>
                                        <div class="modal fade" id="confirmModal{{ $rdv->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form method="PATCH" action="{{ route('rdv.confirm', $rdv->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmer le rendez-vous</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="time">Sélectionner la date :</label>
                                                    <input id='DateInput' type="date" name="date" class="form-control" value="{{$rdv->date}}" required>

                                                    <label for="time">Sélectionner l’heure :</label>
                                                    <input type="time" name="time" class="form-control" step="1800" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div>

                                    </form>
                                    <form action="{{ route('rdv.cancel', $rdv->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button class="btn btn-sm btn-danger">Annuler</button>
                                                                    </form>
                                                                    @elseif ($rdv->status === 'confirmed')
                                                                    <form action="{{ route('rdv.cancel', $rdv->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button class="btn btn-sm btn-danger">Annuler</button>
                                                                    </form>

                                                                @else
                                                                    <em class="text-muted">Aucune action</em>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8" class="text-center text-muted">Aucun rendez-vous trouvé</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var minDate = yyyy + '-' + mm + '-' + dd;
        document.getElementById('DateInput').setAttribute('min', minDate);
    });
</script>

@endsection
