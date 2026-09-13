<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('styles')
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>@yield('title','Khalil Clinique')</title>
  <style>
    body {
  background: linear-gradient(90deg, rgb(230, 242, 255) 0%, rgb(247, 247, 247) 50%, rgba(0, 119, 204, 0.52) 100%);
  font-family: "DM Sans", sans-serif;

    }
.offcanvas .dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0; /* keeps menu aligned */
}
.container {
    margin-bottom: 1.5rem;
}
</style>
  </head>
  <body>

<!-- Toggle button -->
<!-- Toggle button -->
<!-- Toggle button -->

  <div class="container-fluid p-4">
    <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      ☰ Menu
    </button>
  </div>
<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title fw-bold" id="sidebarMenuLabel">Menu de Navigation</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  {{-- Make offcanvas-body flex-column so logout can sit at bottom --}}
  <div class="offcanvas-body d-flex flex-column flex-grow-1">

    @if(Auth::check() && Auth::user()->role === 'admin')
      <a id="dashboardlink" class="nav-link link-dark mb-2" href="{{url('/dashboard')}}" aria-expanded="false">
        Dashboard
      </a>
    @endif

    {{-- 🔹 All your menu links --}}
    <ul class="nav flex-column mb-auto">
      {{-- les Rendez Vous --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="AppoinmentsDropDown"
           data-bs-toggle="dropdown" aria-expanded="false">
          Rendez-vous
        </a>
        <ul class="dropdown-menu" aria-labelledby="imagesDropdown">
          <li><a href="{{url('/ajouter-rdv')}}" class="dropdown-item"> Ajouter Rendez-vous</a></li>
          <li><a href="{{url('/admin/rdv')}}" class="dropdown-item"> Rendez-vous</a></li>
          <li><a href="{{url('/admin/rdv/calendar')}}" class="dropdown-item"> Calendrier</a></li>
        </ul>
      </li>

      {{-- les eventments --}}

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="AppoinmentsDropDown"
           data-bs-toggle="dropdown" aria-expanded="false">
          les evenments
        </a>
        <ul class="dropdown-menu" aria-labelledby="imagesDropdown">
          <li><a href="{{route('events.create')}}" class="dropdown-item"> Ajouter Un Evenment</a></li>
          <li><a href="{{route('events.index')}}" class="dropdown-item"> Toutes les evenments</a></li>
        </ul>
      </li>


      {{-- les Images --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="imagesDropdown"
           data-bs-toggle="dropdown" aria-expanded="false">
          Images
        </a>
        <ul class="dropdown-menu" aria-labelledby="imagesDropdown">
          <li><a href="{{route('galleries.create')}}" class="dropdown-item">Publier Une Image</a></li>
          <li><a href="{{route('galleries.index')}}" class="dropdown-item">Toutes les images</a></li>
        </ul>
      </li>

      {{-- Les Patients --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="patientsDropdown"
           data-bs-toggle="dropdown" aria-expanded="false">
          Patients
        </a>
        <ul class="dropdown-menu" aria-labelledby="patientsDropdown">
          <li><a href="{{route('patients.create')}}" class="dropdown-item">Créer un patient</a></li>
          <li><a href="{{route('patients.index')}}" class="dropdown-item">Tous les patients</a></li>
        </ul>
      </li>
      {{-- Arret De Travail  --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="patientsDropdown"
           data-bs-toggle="dropdown" aria-expanded="false">
          Arret du travail
        </a>
        <ul class="dropdown-menu" aria-labelledby="ArretDeTravailDropdown">
          <li><a href="{{route('arret-de-travail.create')}}" class="dropdown-item">Generer un Arret De Travail</a></li>
        </ul>
      </li>
      {{-- Les Payments --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="paymentsDropdown"
           data-bs-toggle="dropdown" aria-expanded="false">
          Payments
        </a>
        <ul class="dropdown-menu" aria-labelledby="paymentsDropdown">
          @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{route('payments.index')}}" class="dropdown-item">Tous les payments</a></li>
          @endif
          <li><a href="{{route('payment.create')}}" class="dropdown-item">Ajouter un payment</a></li>
        </ul>
      </li>

      {{-- Les Frais --}}
      @if(Auth::check() && Auth::user()->role === 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-dark" href="#" id="fraisDropdown"
             data-bs-toggle="dropdown" aria-expanded="false">
            Frais
          </a>
          <ul class="dropdown-menu" aria-labelledby="fraisDropdown">
            <li><a href="{{route('expenses.index')}}" class="dropdown-item">Tous les frais</a></li>
            <li><a href="{{route('expense.create')}}" class="dropdown-item">Ajouter un frais</a></li>
          </ul>
        </li>
      @endif

      {{-- Mouvements de caisse --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="patientsDropdown2"
           data-bs-toggle="dropdown" aria-expanded="false">
          Mouvements de caisse
        </a>
        <ul class="dropdown-menu" aria-labelledby="patientsDropdown2">
          <li><a href="{{route('cash_movements.create')}}" class="dropdown-item">Créer caisse Mouvment</a></li>
          @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{route('cash_movements.index')}}" class="dropdown-item">Toutes les Mouvments</a></li>
          @endif
        </ul>
      </li>

      {{-- Utilisateurs --}}
      @if(Auth::check() && Auth::user()->role === 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-dark" href="#" id="patientsDropdown3"
             data-bs-toggle="dropdown" aria-expanded="false">
            Utilisateurs
          </a>
          <ul class="dropdown-menu" aria-labelledby="patientsDropdown3">
            <li><a href="{{route('users.create')}}" class="dropdown-item">Créer Un Utilisateurs</a></li>
            <li><a href="{{route('users.index')}}" class="dropdown-item">Toutes les Utilisateurs</a></li>
          </ul>
        </li>
      @endif

      {{-- payments du Bloc --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle link-dark" href="#" id="patientsDropdown4"
           data-bs-toggle="dropdown" aria-expanded="false">
          payments du Bloc
        </a>
        <ul class="dropdown-menu" aria-labelledby="patientsDropdown4">
          <li><a href="{{route('bloc-payments.create')}}" class="dropdown-item">Créer un Payment du Bloc</a></li>
          @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{route('bloc-payments.index')}}" class="dropdown-item">Tous les Payments de bloc</a></li>
          @endif
        </ul>
      </li>
    </ul>

    {{-- 🔴 Logout at bottom --}}
    <div class="mt-auto pt-3 border-top">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger w-100">
          <i class="bi bi-box-arrow-right"></i> Déconnexion
        </button>
      </form>
    </div>
  </div>
</div>


    @yield('content')


  </body>
