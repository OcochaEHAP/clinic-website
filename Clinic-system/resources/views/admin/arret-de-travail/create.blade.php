@extends('layouts.admin')   {{-- ← adjust to your admin layout --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Arrêt de travail</h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('arret-de-travail.generate') }}">
                        @csrf

                        {{-- PATIENT --}}
                        <h6 class="text-uppercase text-muted mt-2 mb-3">Patient</h6>

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">
                                    Nom et prénom <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="patient_name"
                                       class="form-control"
                                       value="{{ old('patient_name') }}"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    Âge <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number"
                                           name="patient_age"
                                           class="form-control"
                                           value="{{ old('patient_age') }}"
                                           min="0" max="150"
                                           required>
                                    <span class="input-group-text">ans</span>
                                </div>
                            </div>
                        </div>

                        {{-- INTERVENTION / ARRÊT --}}
                        <h6 class="text-uppercase text-muted mt-4 mb-3">
                            Intervention et arrêt
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    Date de l'intervention <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="intervention_date"
                                       class="form-control"
                                       value="{{ old('intervention_date') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Date de début de l'arrêt <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="start_date"
                                       id="start_date"
                                       class="form-control"
                                       value="{{ old('start_date') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Durée <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number"
                                           name="duration"
                                           id="duration"
                                           class="form-control"
                                           value="{{ old('duration') }}"
                                           min="1"
                                           required>
                                    <span class="input-group-text">jours</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Date de fin <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="end_date"
                                       id="end_date"
                                       class="form-control"
                                       value="{{ old('end_date') }}"
                                       required>
                                <small class="text-muted">
                                    Automatiquement calculée, mais modifiable.
                                </small>
                            </div>
                        </div>

                        {{-- CERTIFICATE DATE --}}
                        <h6 class="text-uppercase text-muted mt-4 mb-3">
                            Date du certificat
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    Fait le <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="issued_date"
                                       class="form-control"
                                       value="{{ old('issued_date', date('Y-m-d')) }}"
                                       required>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                Générer l'arrêt
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Auto-calculate end_date = start_date + duration - 1 (inclusive) --}}
<script>
(function () {
    const startInput    = document.getElementById('start_date');
    const durationInput = document.getElementById('duration');
    const endInput      = document.getElementById('end_date');

    // Once the user types in the end date, we stop auto-computing.
    let endManuallyEdited = false;
    endInput.addEventListener('input', () => { endManuallyEdited = true; });

    function recalcEnd() {
        if (endManuallyEdited) return;

        const start    = startInput.value;
        const duration = parseInt(durationInput.value, 10);

        if (!start || !duration || duration < 1) return;

        // Inclusive: start + duration - 1 day
        const d = new Date(start + 'T00:00:00');
        d.setDate(d.getDate() + duration - 1);

        const yyyy = d.getFullYear();
        const mm   = String(d.getMonth() + 1).padStart(2, '0');
        const dd   = String(d.getDate()).padStart(2, '0');

        endInput.value = `${yyyy}-${mm}-${dd}`;
    }

    startInput.addEventListener('change', recalcEnd);
    durationInput.addEventListener('input', recalcEnd);
})();
</script>
@endsection
