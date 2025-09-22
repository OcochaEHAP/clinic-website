@extends('layouts.admin')

@section('title', 'Add Event')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Add Event</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Patient</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="service" class="form-label">Service</label>
                    <select name="service" id="service" class="form-select" required>
                        @foreach($services as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label for="time" class="form-label">Temps</label>
                    <input type="time" name="time" id="time" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Notes</label>
                    <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Sauvgarder l'Evenment
                </button>
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
