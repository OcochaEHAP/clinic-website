<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ArretDeTravailController extends Controller
{
    /**
     * Display the form.
     */
    public function create()
    {
        return view('admin.arret-de-travail.create');
    }

    /**
     * Validate the form and render the printable certificate.
     * Nothing is persisted.
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'patient_name'      => 'required|string|max:255',
            'patient_age'       => 'required|integer|min:0|max:150',
            'intervention_date' => 'required|date',
            'start_date'        => 'required|date',
            'duration'          => 'required|integer|min:1',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'issued_date'       => 'required|date',
        ]);

        $duration = (int) $validated['duration'];

        $data = [
            'patientName'      => $validated['patient_name'],
            'patientAge'       => (int) $validated['patient_age'],
            'interventionDate' => Carbon::parse($validated['intervention_date'])->format('d/m/Y'),
            'startDate'        => Carbon::parse($validated['start_date'])->format('d/m/Y'),
            'duration'         => $duration,
            'durationInWords'  => $this->numberToFrenchWords($duration),
            'endDate'          => Carbon::parse($validated['end_date'])->format('d/m/Y'),
            'issuedDate'       => Carbon::parse($validated['issued_date'])->format('d/m/Y'),
        ];

        return view('admin.arret-de-travail.print', $data);
    }

    /**
     * Convert an integer into its French written form.
     * Covers 0 – 999 999 (enough for any plausible work-stop duration).
     */
    private function numberToFrenchWords(int $number): string
    {
        if ($number < 0) {
            return 'moins ' . $this->numberToFrenchWords(-$number);
        }
        if ($number === 0) {
            return 'zéro';
        }

        $units = [
            '', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf',
            'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize',
            'dix-sept', 'dix-huit', 'dix-neuf',
        ];

        $tens = [
            2 => 'vingt', 3 => 'trente', 4 => 'quarante', 5 => 'cinquante',
            6 => 'soixante', 7 => 'soixante', 8 => 'quatre-vingt',
        ];

        $parts = [];

        // Thousands
        if ($number >= 1000) {
            $thousands = intdiv($number, 1000);
            $number %= 1000;
            $parts[] = $thousands === 1
                ? 'mille'
                : $this->numberToFrenchWords($thousands) . ' mille';
        }

        // Hundreds
        if ($number >= 100) {
            $hundreds  = intdiv($number, 100);
            $remainder = $number % 100;

            if ($hundreds === 1) {
                $parts[] = 'cent';
            } else {
                $parts[] = $units[$hundreds] . ' cent' . ($remainder === 0 ? 's' : '');
            }
            $number = $remainder;
        }

        // Tens + units
        if ($number > 0) {
            if ($number < 20) {
                $parts[] = $units[$number];
            } else {
                $tensDigit = intdiv($number, 10);
                $unitDigit = $number % 10;

                if ($tensDigit === 7) {
                    // 70 – 79
                    $r = $number - 60;
                    $parts[] = $r === 11
                        ? 'soixante et onze'
                        : 'soixante-' . $units[$r];
                } elseif ($tensDigit === 9) {
                    // 90 – 99
                    $r = $number - 80;
                    $parts[] = 'quatre-vingt-' . $units[$r];
                } elseif ($unitDigit === 0) {
                    $parts[] = $tensDigit === 8 ? 'quatre-vingts' : $tens[$tensDigit];
                } elseif ($unitDigit === 1) {
                    $parts[] = $tensDigit === 8
                        ? 'quatre-vingt-un'
                        : $tens[$tensDigit] . ' et un';
                } else {
                    $parts[] = $tens[$tensDigit] . '-' . $units[$unitDigit];
                }
            }
        }

        return implode(' ', $parts);
    }
}
