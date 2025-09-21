@extends('layouts.app')
@section('styles')


@endsection
<link rel="stylesheet" href="{{asset('css/services.css')}}">
@section('title', $title)


@section('content')
<div class="service-page">

    <!-- Header section -->
    <section class="service-hero">
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
    </section>

    <!-- Service details card -->
    <section class="service-details">
        <div class="service-card">
            <div class="service-info">
                <h2>Détails du Service</h2>

                <div class="service-block">
                    <h3>Bénéfices</h3>
                    <ul>
                        @foreach ($benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="service-block">
                    <h3>Durée</h3>
                    <p>{{ $duration }}</p>
                </div>

                <div class="service-block">
                    <h3>Pour qui ?</h3>
                    <p>{{ $for }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA button -->
    <section class="service-cta">
        <a href="/rendez-vous" class="cta-btn">Prendre un rendez-vous</a>
    </section>

</div>
@endsection
