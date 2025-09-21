<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlocPayment extends Model
{
        protected $fillable = [

        'patient_id',
        'amount',
        'location_de_bloc',
        'aide',
        'la_gaine',
        'date',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function getNetProfitAttribute()
    {
        return $this->amount - ($this->location_de_bloc + $this->aide + $this->la_gaine);
    }
}
