<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Patient;
use App\Models\RDV;
use Illuminate\Http\Request;

class EventController extends Controller
{
        public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        // 1. Manual events
        $manualEvents = Event::whereDate('date', $date)
            ->get()
            ->each( function($event) {
                $event->source = 'event';
            });

        // 2. Confirmed RDVs
        $confirmedRdvs =  RDV::where('status', 'confirmed')
            ->whereDate('date', $date)
            ->get()
            ->each( function($rdv) {
                $rdv->source = 'rdv';
            });

        // 3. Merge & sort
        $events = $manualEvents->merge($confirmedRdvs)->sortBy(function ($item) {
            return $item->date . ' ' . $item->time;
        });
        $services = [
                'consultation','esthetique','Laser Epilasion','botox','filler','hydrafacial',
                'HIFU visage','HIFU vaginal','Drainage lymphatique','cavitation','Radio frequence'
            ];
        return view('events.index', compact('events', 'date','services'));
    }

    /**
     * Show the form for creating a new manual event.
     */
        public function create()
        {
            // $patients = Patient::all();
            $services = [
                'consultation','esthetique','Laser Epilasion','botox','filler','hydrafacial',
                'HIFU visage','HIFU vaginal','Drainage lymphatique','cavitation','Radio frequence'
            ];

            return view('events.create', compact('services'));
        }

    /**
     * Store a newly created manual event in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'service'    => 'required|string',
            'date'       => 'required|date',
            'time'       => 'nullable|date_format:H:i',
            'message'    => 'nullable|string'
        ]);

        Event::create([
            'name' => $request->name,
            'service'    => $request->service,
            'date'       => $request->date,
            'time'       => $request->time,
            'message'    => $request->message,
        ]);

        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }


        public function edit($id)
    {

        $event = Event::findOrFail($id);
        return view('events.edit', compact('event','services'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->only('service','date','time','message'));
        return redirect()->route('events.index')->with('success','Événement mis à jour.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success','Événement supprimé.');
    }

}
