{{-- resources/views/rdv/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouveau Rendez-vous')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
          <h5 class="mb-0 fw-bold">Ajouter un rendez-vous</h5>
        </div>

        <div class="card-body">
          {{-- errors --}}
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
          @endif

          <form action="{{ route('RDV.create') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
              <label for="name" class="form-label">Nom complet</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}" placeholder="Ex : Mohamed Ali" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                     value="{{ old('phone') }}" placeholder="+213 6X XX XX XX" required>
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email <span class="text-muted">(optionnel)</span></label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" placeholder="ex@domaine.com">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Date & Time --}}
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label for="DateInput" class="form-label">Date</label>
                <input type="date" name="date" id="DateInput" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date') }}" required>
                @error('date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="time" class="form-label">Heure <span class="text-muted">(optionnel)</span></label>
                <input type="time" name="time" step="1800" id="time"
                       class="form-control @error('time') is-invalid @enderror"
                       value="{{ old('time') }}">
                @error('time')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            {{-- Service --}}
            <div class="mb-3">
              <label for="service" class="form-label">Service</label>
              <select name="service" id="service" class="form-select @error('service') is-invalid @enderror" required>
                 <option value="">-- Sélectionnez un service --</option>
                 <option value="consultation" {{ old('service')=='consultation' ? 'selected' : '' }}>Consultation</option>
                 <option value="esthetique" {{ old('service')=='esthetique' ? 'selected' : '' }}>Esthétique</option>
                 <option value="Laser Epilasion" {{ old('service')=='Laser Epilasion' ? 'selected' : '' }}>Laser Epilation</option>
                 <option value="botox" {{ old('service')=='botox' ? 'selected' : '' }}>Botox</option>
                 <option value="filler" {{ old('service')=='filler' ? 'selected' : '' }}>Filler</option>
                 <option value="hydrafacial" {{ old('service')=='hydrafacial' ? 'selected' : '' }}>Hydrafacial</option>
                 <option value="HIFU visage" {{ old('service')=='HIFU visage' ? 'selected' : '' }}>HIFU Visage</option>
                 <option value="HIFU vaginal" {{ old('service')=='HIFU vaginal' ? 'selected' : '' }}>HIFU Vaginal</option>
                 <option value="Drainage lymphatique" {{ old('service')=='Drainage lymphatique' ? 'selected' : '' }}>Drainage Lymphatique</option>
                 <option value="cavitation" {{ old('service')=='cavitation' ? 'selected' : '' }}>Cavitation</option>
                 <option value="Radio frequence" {{ old('service')=='Radio frequence' ? 'selected' : '' }}>Radio Fréquence</option>
                 <option value="Reclamation" {{ old('service')=='Reclamation' ? 'selected' : '' }}>Réclamation</option>
                 <option value="Controle" {{ old('service')=='Controle' ? 'selected' : '' }}>Contrôle</option>
              </select>
              @error('service')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Message --}}
            <div class="mb-3">
              <label for="message" class="form-label">Message <span class="text-muted">(optionnel)</span></label>
              <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                        rows="3" placeholder="Écrivez une remarque...">{{ old('message') }}</textarea>
              @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Hidden Status --}}
            <input type="hidden" name="status" value="confirmed">

            {{-- Type --}}
            <div class="mb-3">
              <label for="type" class="form-label">Type</label>
              <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                 <option value="bloc" {{ old('type')=='bloc' ? 'selected' : '' }}>Bloc</option>
                 <option value="clinique" {{ old('type')=='clinique' ? 'selected' : '' }}>Clinique</option>
              </select>
              @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Submit Buttons --}}
            <div class="d-flex justify-content-end gap-2">
              <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle"></i> Annuler
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  var minDate = yyyy + '-' + mm + '-' + dd;
  document.getElementById('DateInput').setAttribute('min', minDate);
});
</script>
@endsection
