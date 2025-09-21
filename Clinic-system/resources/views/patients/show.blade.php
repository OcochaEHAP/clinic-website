@extends('layouts.admin')
@section('title', 'Détails du patient')
@section('content')
<div class="container">
    <h2 class="mb-4"> Détails du patient</h2>

    <!-- Section 1: Infos Patient -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Informations du patient</div>
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <p class="form-control-plaintext">{{ $patient->first_name }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <p class="form-control-plaintext">{{ $patient->last_name }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label">Âge</label>
                <p class="form-control-plaintext">{{ $patient->age }}</p>
            </div>
            <div class="col-md-9">
                <label class="form-label">Adresse</label>
                <p class="form-control-plaintext">{{ $patient->address }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Téléphone</label>
                <p class="form-control-plaintext">{{ $patient->phone }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">N° Carte Nationale</label>
                <p class="form-control-plaintext">{{ $patient->card_number }}</p>
            </div>
        </div>
    </div>

    <!-- Section 2: Intervention Prévue -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Type d’intervention prévue</div>
        <div class="card-body row g-3">
            @php
                $interventions = is_array($patient->interventions)
                    ? $patient->interventions
                    : json_decode($patient->interventions, true);
            @endphp

            <div class="col-md-6">
                <label class="form-label fw-bold">Chirurgie Esthétique</label>
                <ul>
                    @foreach([
                        'Liposuccion','Lipofilling','BBL','Abdominoplastie',
                        'Réduction mammaire','Augmentation mammaire (Prothèse)',
                        'Augmentation mammaire (Lipofilling)'
                    ] as $c)
                        <li>
                            {{ $c }} :
                            {!! in_array($c, $interventions ?? []) ? '✅' : '❌' !!}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Esthétique sans chirurgie</label>
                <ul>
                    @foreach([
                        'Filler / Botox','Hydrafacial','Épilation laser','HIFU visage','HIFU vaginal','Drainage'
                    ] as $c)
                        <li>
                            {{ $c }} :
                            {!! in_array($c, $interventions ?? []) ? '✅' : '❌' !!}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Chirurgie générale</label>
                <p class="form-control-plaintext">
                    {{ $patient->chirurgie_generale ?? 'Aucune' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Antécédents -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Antécédents Chirurgicaux</h5>
        </div>
        <div class="card-body">
            <p><strong>Opérations précédentes:</strong> {{ $patient->operations_precedentes }}</p>
            <p><strong>Complications:</strong> {{ $patient->complications }}</p>
        </div>
    </div>

    <!-- Habitudes -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Habitudes</h5>
        </div>
        <div class="card-body">
            <p><strong>Tabac:</strong> {{ ucfirst($patient->tabac) }}</p>
            <p><strong>Alcool:</strong> {{ ucfirst($patient->alcool) }}</p>
            <p><strong>Autres habitudes:</strong> {{ $patient->autres_habitudes }}</p>
        </div>
    </div>

    <!-- Examen clinique -->
    <div class="card mb-4 mt-4">
        <div class="card-header bg-info text-white">Examen clinique</div>
        <div class="card-body row g-3">
            <div class="col-md-4">
                <label class="form-label">Poids (kg)</label>
                <p class="form-control-plaintext">{{ $patient->weight }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label">Taille (cm)</label>
                <p class="form-control-plaintext">{{ $patient->tall }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label">IMC (BMI)</label>
                <p class="form-control-plaintext">{{ $patient->bmi }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Morphologie</label>
                <p class="form-control-plaintext">{{ $patient->morphologie }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Qualité de la peau</label>
                <p class="form-control-plaintext">{{ $patient->peau }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Accumulation de graisse</label>
                <p class="form-control-plaintext">{{ $patient->graisse }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Zones de dépression</label>
                <p class="form-control-plaintext">{{ $patient->zones }}</p>
            </div>
        </div>
    </div>

    <!-- Examen mammaire -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">Examen mammaire</div>
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label">Hypertrophie mammaire</label>
                <p class="form-control-plaintext">{{ $patient->hypertrophie }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label">Ptose mammaire</label>
                <p class="form-control-plaintext">{{ $patient->ptose }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label">Asymétrie mammaire</label>
                <p class="form-control-plaintext">{{ $patient->asymetrie }}</p>
            </div>
        </div>
    </div>

    <!-- Back button -->
    <div class="d-flex justify-content-end">
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">⬅ Retour</a>
    </div>
</div>
@endsection
