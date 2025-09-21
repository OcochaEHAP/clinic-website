@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/rdv.css')}}">

@endsection

@section('title','Rendez-Vous')


@section('content')

  <div class="container">
    <div class="hero">
      <h2>Prenez Rendez-Vous</h2>
      <p class="description">Planifiez votre consultation en quelques clics</p>
    </div>

    <section class="how">
      <h2>le processus de prise de rendez-vous</h2>
      <div class="cards">


      <div class="card">
        <h3 class="title">Etape 1</h3>
        <p class="description">
          remplissez le formulaire avec vos informations correctes et la date à laquelle vous souhaitez obtenir un rendez-vous
        </p>
      </div>
      <div class="card">
        <h3 class="title">Etape 2</h3>
        <p class="description">
          Gardez votre téléphone à proximité, nous vous appellerons pour confirmer votre rendez-vous ou vous enverrons un e-mail
        </p>
      </div>
    </div>
    </section>
    <form  method="post" action="{{ route('RDVstore') }}" class="rdv-form">
        @csrf

       {{-- Nom complet --}}
      <div class="form-group">
        <label for="name">Nom complet</label>
        <input type="text" id="name" name="name" value="{{old('name')}}" required>
      </div>

       {{-- Téléphone --}}
      <div class="form-group">
        <label for="phone">Numéro de téléphone</label>
        <input type="tel" id="phone" name="phone" value="{{old('phone')}}" required>
      </div>

       {{-- Email --}}
      <div class="form-group">
        <label for="email">Email (optionnel)</label>
        <input type="email" id="email" name="email" value="{{old('email')}}">
      </div>

      <!-- {{-- Date --}} -->
      <div class="form-group">
        <label for="date">Date souhaitée</label>
        <input type="date" id="DateInput" name="date" value="{{old('date')}}" required>
      </div>

      <!-- {{-- Heure [DELETED]--}} -->


      <!-- {{-- Service --}} -->
      <div class="form-group">
            <label for="service">Choisir un service</label>
            <select id="service" name="service" class="form-control" required>
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
            </div>


      <!-- {{-- Message --}} -->
      <div class="form-group">
        <label for="message">Message / Notes</label>
        <textarea id="message" name="message" rows="3" value="{{old('messge')}}"></textarea>
      </div>

      <!-- {{-- Submit --}} -->
      <div class="form-actions">
        <button type="submit" class="btn-submit">
          Confirmer mon rendez-vous
        </button>
      </div>
    </form>
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
