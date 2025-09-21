@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    /* Optional: make gallery images uniform height */
    .gallery-item img {
        object-fit: cover;
        height: 250px;
    }

    @media (max-width: 576px) {
        .gallery-item img {
            height: 200px;
        }
    }
</style>
@endsection

@section('title', 'Toutes les photos')

@section('content')
<div class="container my-5">

    <!-- Header Row -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-12 col-md-6">
            <h2 class="fw-bold text-center text-md-start">Gallery De Résultats</h2>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
            <form method="GET" action="{{ route('galleries.index') }}" class="w-100" style="max-width: 260px;">
                <div class="input-group">
                    <label class="input-group-text">Trier</label>
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Le plus récent</option>
                        <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Le plus ancien</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card shadow-sm h-100 gallery-item" data-id="{{ $gallery->id }}">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                         class="card-img-top rounded-top"
                         alt="Avant & Après">
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Aucune image trouvée dans la galerie.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
