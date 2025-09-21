<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug) {
    $services = config('services_data');
    $service = collect($services)->firstWhere('slug', $slug);

    abort_unless($service, 404);

    return view('services.show', $service);
}
}
