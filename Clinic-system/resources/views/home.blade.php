@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet/dist/leaflet.css"
/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endsection



@section('content')

  <div class="container">

    <div data-aos="fade-up" data-aos-duration="1500" class="hero">
      <div>
        <h1> Bienvenue dans khalil clinique </h1>
        <p>
          Soins esthetiques et
        </p>
        <span> chirurgies de confiance</span>
        <button> <a href="{{url('/rendez-vous')}}"> Prendre un rendez-vous</a></button>
      </div>
    </div>
    <div data-aos="fade-up" data-aos-duration="1500" id="doctor" class="doctor">
      <div class="title">
        <h2>Dr. Akkouche</h2>
      </div>
      <div class="description">
        <p>
          Dr. Akkouche est une spécialiste en médecine esthétique et chirurgie reconstructive. Avec plusieurs années
          d’expérience,
          elle allie expertise, écoute et précision pour accompagner chaque patient·e avec soin. Son approche humaine
          fait de sa
          clinique un espace de confiance.
        </p>
      </div>
    </div>

  </div>


 <h2 class="services-title">Nos Services</h2>

    <div class="services-grid">
        @php

        $services = [
            ['title' => 'Liposuccion', 'slug' => 'liposuccion'],
            ['title' => 'Lipofilling', 'slug' => 'lipofilling'],
            ['title' => 'Brazilian Butt Lift (BBL)', 'slug' => 'bbl'],
            ['title' => 'Abdominoplastie', 'slug' => 'abdominoplastie'],
            ['title' => 'Réduction mammaire', 'slug' => 'reduction-mammaire'],
            ['title' => 'Augmentation mammaire', 'slug' => 'augmentation-mammaire'],
            ['title' => 'Lipofilling mammaire', 'slug' => 'lipofilling-mammaire'],
            ['title' => 'Filler / Botox', 'slug' => 'filler-botox'],
            ['title' => 'HydraFacial', 'slug' => 'hydrafacial'],
            ['title' => 'Épilation laser', 'slug' => 'epilation-laser'],
            ['title' => 'HIFU visage & vaginal', 'slug' => 'hifu'],
            ['title' => 'Chirurgie générale', 'slug' => 'chirurgie-generale'],
        ];
        @endphp


        @foreach($services as $service)
        <div class="service-card">
            <h5 class="service-title">{{ $service['title'] }}</h5>
            {{-- <a href="" class="service-btn">En savoir plus</a> --}}
            <a href="{{ route('services.show',$service['slug']) }}" class="service-btn">En savoir plus</a>
        </div>
        @endforeach
    </div>

  <div class="container" style="background-color: none;">
    <div data-aos="fade-up" data-aos-duration="1500" id="adress" class="adress">
      <div class="text">
        <h2>Emplacment</h2>
        <p>Bab Ezzouar ,<br>Cité 2068 logement bâtiment 57 <br>numéro 37, <br>
          Dim - Jeu: 09h00 - 17h00 <br>
          <br> Vendredi: Fermé
        </p>
        <button>
          <a href="https://maps.app.goo.gl/mc7CWdtFCx6UTQRM6" target="_blank">
            Visiter-nous
          </a>
        </button>
      </div>
      <div id="map" style="width: 100%; height: 400px; border-radius: 8px;"></div>
    </div>
    <div data-aos="fade-up" data-aos-duration="1500" id="contact" class="contact">
      <h2>Contactez-Nous</h2>
      <div class="box-container">
        <div class="box">
          <img class="icon" src="{{asset('icons/instagram-brands-solid.svg')}}" alt="instgram icon">
          <div class="text"> <a href="https://www.instagram.com/docteur_akkouche/" target="_blank" rel="noopener noreferrer">@docteur_akkouche</a> </div>
        </div>
        <div class="box">
          <img class="icon" src="{{asset('icons/facebook-brands.svg')}}" alt="facebook icon">
          <div class="text"> <a href="https://www.facebook.com/profile.php?id=100077588537561" target="_blank" rel="noopener noreferrer">@Doc Akk</a>
          </div>
        </div>
        <div class="box">
          <img class="icon" src="{{asset('icons/phone-solid.svg')}}" alt="phone icon">
          <div class="text"> <br> 0782 22 80 45</div>
        </div>
        <div class="box">
          <img class="icon" src="{{asset('icons/phone-solid.svg')}}" alt="phone icon">
          <div class="text">  <br> 0662 77 09 67</div>
        </div>
      </div>


    </div>
  </div>


  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
      const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
      document.querySelectorAll('.nav-links a').forEach(link => link.addEventListener('click', () => {
                  hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
      }));

        hamburger.addEventListener('click', () => {
          hamburger.classList.toggle('active');
          navLinks.classList.toggle('active');
        });

          const map = L.map('map').setView([36.7157372, 3.1896411], 15);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  const marker = L.marker([36.7157372, 3.1896411]).addTo(map);
  marker.bindPopup(`
    <strong>Clinique el Khalil</strong><br>
    Pour esthetiques et tumors
  `).openPopup();
  </script>
@endsection


