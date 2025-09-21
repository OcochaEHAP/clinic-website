@extends('layouts.admin')
@section('styles')
<style>
  /* Make calendar fit nicely inside Bootstrap card */
  #calendar {
    max-width: 100%;
    margin: 20px auto;
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Customize header */
  .fc-toolbar-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
  }

  /* Style buttons */
  .fc-button {
    background: #0d6efd;
    border: none;
    border-radius: 5px;
    color: #fff;
    padding: 6px 12px;
  }
  .fc-button:hover {
    background: #0b5ed7;
  }

  /* Event appearance */
  .fc-event {
    background: #198754;
    border: none;
    border-radius: 4px;
    padding: 2px 4px;
    font-size: 0.875rem;
    color: #ffffff;
  }
</style>


       <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js "></script>
@endsection
@section('title','calendrier')

@section('content')
 <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="rdvType" class="form-label fw-bold">Filtrer par type</label>
                <select id="rdvType" class="form-select shadow-sm">
                <option value="all">Tous les rendez-vous</option>
                <option value="bloc">Bloc</option>
                <option value="clinique">Clinique</option>
                </select>
            </div>
        </div>

        <h2 class="mb-3">calendrier de RDVs</h2>
        <div id="calendar"></div>
 </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'fr',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
            list: 'Liste'
        },
        events: {
            url: "{{ route('rdv.calendar.data') }}", // Laravel route
            extraParams: function () {
                return {
                    type: document.getElementById('rdvType').value
                };
            }
        },
        eventContent: function(arg) {
            let parts = arg.event.title.split('|');
            let name = parts[0];
            let service = parts[1] ?? '';
            return {
                html: `
                    <div>
                        <strong>${name}</strong><br>
                        <small>${service}</small>
                    </div>
                `
            }
        }
    });

    calendar.render();

    // Refresh events when type changes
    document.getElementById('rdvType').addEventListener('change', function () {
        calendar.refetchEvents();
    });
});
</script>
@endsection
