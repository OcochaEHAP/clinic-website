<?php

namespace App\Http\Controllers;

use App\Models\RDV;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
// use Intervention\Image\Laravel\Facades\Image;

class RDVController extends Controller
{


    public function index(Request $request)
    { $query = RDV::query();

        if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Search by name or phone
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('phone', 'like', '%' . $request->search . '%');
    }

    // Filter by service
    if ($request->filled('service')) {
        $query->where('service', $request->service);
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $rdvs = $query->orderBy('date', 'asc')->get();

        $rdvs =  $rdvs = $query->orderBy('date', 'asc')->get();
        return view('/admin.rdv',compact('rdvs'));
    }

    public function calendar()
{
    return view('admin.calendar'); // just return Blade
}
public function calendarData(Request $request)
{
    $query = Rdv::query()
        ->where('status', 'confirmed'); // only confirmed rdvs

    if ($request->has('type') && $request->type !== 'all') {
        $query->where('type', $request->type); // filter by "bloc" or "clinique"
    }

    $rdvs = $query->get();

    $events = $rdvs->map(function ($rdv) {
        if ($rdv->type === 'bloc') {
            $bgColor = '#007bff'; // blue
            $textColor = '#fff';
        } else {
            $bgColor = '#28a745'; // green
            $textColor = '#fff';
        }
        return [
            'id'    => $rdv->id,
            'title' => $rdv->name . '|' . ucfirst($rdv->service),
            'start' => $rdv->time
                ? $rdv->date . ' ' . $rdv->time   // ✅ Use both date + time
                : $rdv->date,                     // fallback (all-day if no time yet)
            'allDay' => $rdv->time ? false : true, // ✅ force timed events if hour exists // make sure it's datetime format
            'backgroundColor' => $bgColor,
            'borderColor'     => $bgColor,
            'textColor'       => $textColor,
        ];
    });

    return response()->json($events);
}


// public function calendarData()
// {
//     $rdvs = RDV::where('status','confirmed')->get();

//     $events = $rdvs->map(function ($rdv) {
//         return [
//             'id'    => $rdv->id,
//             'title' => $rdv->name . '|' . ucfirst($rdv->service),
//               'start' => $rdv->time
//                 ? $rdv->date . ' ' . $rdv->time   // ✅ Use both date + time
//                 : $rdv->date,                     // fallback (all-day if no time yet)
//             'allDay' => $rdv->time ? false : true, // ✅ force timed events if hour exists // make sure it's datetime format
//             'color' => '#0077cc'
//         ];
//     });

//     return response()->json($events);
// }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validatedRDV = request()->validate( [
        'name' => 'required|string|min:3|max:100',
        'phone'  => 'required|regex:/^[0-9+\-\s()]*$/|min:6|max:20',
        'email'         => 'nullable|email|max:150',
        'date'          => 'required|date|after_or_equal:today',
        'service' => 'required|in:consultation,esthetique,Laser Epilasion,botox,filler,hydrafacial,HIFU visage,HIFU vaginal,Drainage lymphatique,cavitation,Radio frequence,Reclamation,Controle',
        'message'       => 'nullable|string|max:500',
        'status'        => 'string|in:pending,confirmed,canceled',
        ]);
        RDV::create($validatedRDV);
        return redirect()->route('rdv.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRDV = request()->validate( [
        'name' => 'required|string|min:3|max:100',
        'phone'  => 'required|regex:/^[0-9+\-\s()]*$/|min:6|max:20',
        'email'         => 'nullable|email|max:150',
        'date'          => 'required|date|after_or_equal:today',
        'service' => 'required|in:consultation,esthetique,Laser Epilasion,botox,filler,hydrafacial,HIFU visage,HIFU vaginal,Drainage lymphatique,cavitation,Radio frequence,Reclamation,Controle',
        'message'       => 'nullable|string|max:500',
        'type' => 'requierd|in:bloc,clinique'
        ]);
        RDV::create($validatedRDV);
        return redirect()->route('rdv.confirmation');
    }

        public function confirm(Request $request, $id)
    {
        $rdv = RDV::findOrFail($id);
        $rdv->status = 'confirmed';
            $rdv->time = $request->time;
        $rdv->save();

        return redirect()->route('rdv.index')->with('success', 'Rendez-vous confirmé ✅');
    }

    public function cancel($id)
    {
        $rdv = RDV::findOrFail($id);
        $rdv->status = 'cancelled';
        $rdv->save();

        return redirect()->route('rdv.index')->with('error', 'Rendez-vous annulé ❌');
    }
}
